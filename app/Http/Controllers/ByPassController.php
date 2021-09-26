<?php

namespace App\Http\Controllers;

use Kai;
use Client;
use Sentinel;
use App\UserRole;
use Illuminate\Http\Request;

class ByPassController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $credentials = [
            'email' => 'dummyadministrator@mailinator.com', 'password' => 'password', 'permissions' => ['admin' => true], 'first_name' => 'DummyAdmin', 'last_name' => 'Istrator'
        ];

        $credentials_validation = [
            'email' => 'dummyadministrator@mailinator.com', 'password' => 'password'
        ];

        $user_validation = Sentinel::validForCreation($credentials_validation);

        if ($user_validation) {

            $user = Sentinel::registerAndActivate($credentials);
            $user_role = UserRole::create(['user_id' => $user->id, 'role_id' => 1]);
            if ($user_role) {
                return response()->json(['success' => true, 'message' => 'Add Dummy Users Admin Success'], 201);
            } else {
                return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $auth = Sentinel::authenticate($credentials);
        if ($auth) {

            return response()->json(['success' => true, 'message' => 'authenticate success', 'data' => $auth], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'authenticate failled, Invalid credentials'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_auth()
    {
        $user = Sentinel::check();
        if ($user) {
            return response()->json(['success' => true, 'message' => 'User is Logged in', 'data' => $auth], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User is not login'], 400);
        }
    }

    public function get_province()
    {
        $getData = Client::setEndpoint('province')
            ->setHeaders(['key' => $this->ApiKey()])
            ->setQuery([])
            ->get();
        foreach ($getData['rajaongkir']['results'] as $key => $value) {
            $value['id'] = $value['province_id'];
            $value['text'] = $value['province'];
            $getData['rajaongkir']['results'][$key] = $value;
        }

        return response()->json(['result' => $getData['rajaongkir']]);
    }

    public function get_city(Request $request)
    {
        $request_data = [
            'province' => $request->province
        ];
        $getData = Client::setEndpoint('city')
            ->setHeaders(['key' => $this->ApiKey()])
            ->setQuery($request_data)
            ->get();
        foreach ($getData['rajaongkir']['results'] as $key => $value) {
            $value['id'] = $value['city_id'];
            $value['text'] = ($value['type'] == 'Kabupaten' ? 'Kab. ' : 'Kota. ') . '' . $value['city_name'];
            $getData['rajaongkir']['results'][$key] = $value;
        }

        return response()->json(['result' => $getData['rajaongkir']]);
    }

    public function get_subdistrict(Request $request)
    {
        $request_data = [
            'city' => $request->city
        ];
        $getData = Client::setEndpoint('subdistrict')
            ->setHeaders(['key' => $this->ApiKey()])
            ->setQuery($request_data)
            ->get();
        foreach ($getData['rajaongkir']['results'] as $key => $value) {
            $value['id'] = $value['subdistrict_id'];
            $value['text'] = 'Kec. ' . $value['subdistrict_name'];
            $getData['rajaongkir']['results'][$key] = $value;
        }

        return response()->json(['result' => $getData['rajaongkir']]);
    }

    public function get_cost(Request $request)
    {
        $post_data = $request->all();

        $getData = Client::setEndpoint('cost')
            ->setHeaders(['key' => $this->ApiKey()])
            ->setBody($post_data)
            ->post();
        foreach ($getData['rajaongkir']['results'][0]['costs'] as $key => $value) {
            $value['id'] = $value['cost'][0]['value'];
            $value['text'] = $value['service'] . '- Estimasi ' . $value['cost'][0]['etd'];
            $getData['rajaongkir']['results'][$key] = $value;
        }

        return response()->json(['result' => $getData['rajaongkir']]);
    }

    public function ApiKey()
    {
        $api_key = env('RAJAONGKIR_APIKEY', null);
        return $api_key;
    }

    public static function encrypt($plaintext)
    {
        $cipher = env('cipher');
        $key = env('key');
        $iv = env('iv');
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, false, $iv);

        return $ciphertext_raw;
    }

    public function getTime($date)
    {
        $time = explode(" ", $date);
        return $time[1];
    }

    // FUNCTION FOR MIDDLEWARE GET SCHEDULE PROJECT KAI ACCESS
    public function getSchedule(Request $request)
    {
        $org = $this->encrypt($request->staorigincode);
        $des = $this->encrypt($request->stadestinationcode);
        $dte = $this->encrypt($request->tripdate);
        $org_name = $request->org;
        $des_name = $request->des;

        $param_data = [
            "staorigincode" => $org,
            "stadestinationcode" => $des,
            "tripdate" => $dte
        ];

        $hit_data = Kai::setEndpoint('getscheduleune')
            ->setHeaders(['Content-Type' => 'application/json'])
            ->setBody($param_data)
            ->post();

        $depart = [
            "code" => $hit_data['payload'][0]['orgcode'],
            "name" => $org_name,
            "is_portertaxi" => 0
        ];

        $arrival = [
            "code" => $hit_data['payload'][0]['destcode'],
            "name" => $des_name,
            "is_portertaxi" => 0
        ];

        foreach ($hit_data['payload'] as $key => $value) {
            $value['train_name'] = $value['trainname'];
            $value['date_depart'] = date("d-m-Y", strtotime($value['tripdate']));
            $value['date_return'] = date("d-m-Y", strtotime($value['tripdate']));
            $value['time_depart'] = $this->getTime($value['departdatetime']);
            $value['time_return'] = $this->getTime($value['arrivaldatetime']);
            $value['train_code'] = $value['noka'];
            $value['class'] = $value['wagonclasscode'];
            $value['subclass'] = $value['subclass'];
            $value['adult_price'] = "Rp " . $value['fares'][0]['amount'];
            $value['adult_num_price'] = intval($value['fares'][0]['amount']);
            $value['child_price'] = "Rp 0";
            $value['child_num_price'] = 0;
            $value['infant_price'] = "Rp 0";
            $value['infant_num_price'] = 0;
            $value['available'] = $value['availability'] > 0 ?  true : false;
            $value['totall_seat'] = $value['availability'];

            $hit_data['payload'][$key] = $value;
        }


        return response()->json([
            "status" => 200, "message" => "",
            "data" => [[
                "depart" => $depart,
                "arrival" => $arrival,
                "schedule" => $hit_data['payload']
            ]]

        ], 200);
    }

    public function booking(Request $request)
    {
        $propscheduleid = $this->encrypt($request->propscheduleid);
        $tripid         = $this->encrypt($request->tripid);
        $orgid          = $this->encrypt($request->orgid);
        $desid          = $this->encrypt($request->desid);
        $orgcode        = $this->encrypt($request->orgcode);
        $destcode       = $this->encrypt($request->destcode);
        $tripdate       = $this->encrypt($request->tripdate);
        $departdate     = $this->encrypt($request->departdate);
        $noka           = $this->encrypt($request->noka);
        $extrafee       = $this->encrypt($request->extrafee);
        $wagonclasscode = $this->encrypt($request->wagonclasscode);
        $wagonclassid   = $this->encrypt($request->wagonclassid);
        $customername   = $this->encrypt($request->customername);
        $phone          = $this->encrypt($request->phone);
        $email          = $this->encrypt($request->email);
        $subclass       = $this->encrypt($request->subclass);
        $totpsgadult    = $this->encrypt($request->totpsgadult);
        $totpsgchild    = $this->encrypt($request->totpsgchild);
        $totpsginfant   = $this->encrypt($request->totpsginfant);
        $idnum          = $this->encrypt($request->idnum);
        $name           = $this->encrypt($request->name);
        $psgtype        = $this->encrypt($request->psgtype);
        $params = [

            "propscheduleid" => $propscheduleid,
            "tripid" => $tripid,
            "orgid" => $orgid,
            "desid" => $desid,
            "orgcode" => $orgcode,
            "destcode" => $destcode,
            "tripdate" => $tripdate,
            "departdate" => $departdate,
            "noka" => $noka,
            "extrafee" => $extrafee,
            "wagonclasscode" => $wagonclasscode,
            "wagonclassid" => $wagonclassid,
            "customername" => $customername,
            "phone" => $phone,
            "email" => $email,
            "subclass" => $subclass,
            "totpsgadult" => $totpsgadult,
            "totpsgchild" => $totpsgchild,
            "totpsginfant" => $totpsginfant,
            "paxes" => [

                "idnum" => $idnum,
                "name" => $name,
                "psgtype" => $psgtype

            ]

        ];

        $hit_data = Kai::setEndpoint('booking')
            ->setHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'token_authenticate'
            ])
            ->setBody($params)
            ->post();

        return response()->json([
            "status"    => 200,
            "message"   => "Booking Success!",
            "data"      => []


        ]);
    }
}
