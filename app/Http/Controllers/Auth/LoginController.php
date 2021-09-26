<?php

namespace App\Http\Controllers\Auth;

use Closure;
use Sentinel;
use Session;
use Activation;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cartalyst\Sentinel\Activations\EloquentActivation;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LoginForm()
    {
        return view('auth.index');
    }

    /**
     * This Function for Authenticate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati <WA: 085721731478>
     */
    public function store(LoginRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $cek = Sentinel::findByCredentials($credentials);
        $Verifikasi_cek = isset($cek->activations[0]['completed']) ? $cek->activations[0]['completed'] : true ;
        if ($Verifikasi_cek) {
            $auth = Sentinel::authenticate($credentials);
            if($auth){
                $roles = $auth->roles->first()->name;
                session([ 'authenticate' => $auth ]);
                if($roles == 'Admin'){
                    return $this->PageAdmin();
                }else{
                    \Session::flash('success_authenticate', 'anda berhasil login, selamat datang!');
                    return redirect()->back();
                }
                // return $this->RedirectToRole($roles);
            }else{
                    return redirect()->back()->withInput()->with([
                        'error-login' => 'Email atau Password salah!'
                    ]);
            }   
        }else{
            return redirect()->back()->withInput()->with([
                'error-login' => 'Akun Anda Belum di Verifikasi, Silahkan Verifikasi Terlebih dahulu!'
            ]);
        }
    }

    /**
     * This Function For Verifications
     * @param \Illuminate\Http\Request  $request, $verification_code
     * @author Rangga Darmajati <WA: 085721731478>
     */

    public function verifications($verification_code)
    {
        Carbon::setLocale('id');
        $now = Carbon::now();
        $cek_token = \DB::table('activations')->where('code', $verification_code)->first();
        $user = Sentinel::findById($cek_token->user_id);
        if($cek_token){
            $active = Activation::complete($user, $verification_code);
            if ($active) {
                \Session::flash('success_authenticate', 'anda berhasil Verifikasi, Silahkan Login!');
                return redirect()->route('home');
            }else{
                \Session::flash('error-login', 'Oops .. Verifikasi Gagal!');
                return redirect()->route('home');    
            }
        }else{
            \Session::flash('error-login', 'Oops .. Verifikasi Gagal, kode verifikasi anda tidak valid!');
            return redirect()->route('home');
        }
    }

    // /**
    //  * This Function for Authenticate.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  * @author Rangga Darmajati <WA: 085721731478>
    //  */
    // public function store(LoginRequest $request)
    // {
    //     $credentials = [
    //         'email'    => $request->email,
    //         'password' => $request->password,
    //     ];

    //     $auth = Sentinel::authenticate($credentials);
        
    //     if($auth){
    //         $roles = $auth->roles->first()->name;
    //         session([ 'authenticate' => $auth ]);
    //         if($roles == 'Admin'){
    //             return $this->PageAdmin();
    //         }else{
    //              \Session::flash('success_authenticate', 'anda berhasil login, selamat datang!');
    //              return redirect()->back();
    //         }
    //         // return $this->RedirectToRole($roles);
    //     }else{
    //         return redirect()->back()->withInput()->with([
    //             'error-login' => 'Email atau Password salah!'
    //         ]);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function RegisterForm()
    {
        return view('auth.register');
    }

    /**
     * This Function for Authenticate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati <WA: 085721731478>
     */
    public function register(RegisterRequest $request)
    {
        $email = $request->email;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $permissions = ['admin' => false];
        $password = $request->password;
        $name = $first_name.' '.$last_name;
        
        $credentials = [
            'email' => $email
            ,'password' => $password
            ,'permissions' => $permissions
            ,'first_name' => ucwords($first_name)
            ,'last_name' => ucwords($last_name)
        ];

        $credentials_validation = [
            'email' => $email
            ,'password' => $password
        ];

        $user_validation = Sentinel::validForCreation($credentials_validation);

        if ($user_validation){
            
            // $user = Sentinel::registerAndActivate($credentials);
            $user = Sentinel::register($credentials);
            $activate_key =  Activation::create($user);
            $verification_code = $activate_key->code;
            $user_role = UserRole::create(['user_id' => $user->id, 'role_id' => 2]);
            if($user_role){
                // send email who customer register
                $subject = "Mohon Verifikasi Alamat Email Anda.";
                Mail::send('mails.verify', ['name' => $name, 'verification_code' => $verification_code],
                    function($mail) use ($email, $name, $subject){
                        $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $mail->to($email, $name);
                        $mail->subject($subject);
                });

                return redirect()->route('home')->with(['success_authenticate' => 'Anda Berhasil daftar, untuk dapat Login, silahkan cek email anda untuk Verifikasi akun!']);
            }else{
                return redirect()->back()->withInput()->with([
                    'failed-register' => 'Anda Gagal daftar, silahkan coba kembali!'
                ]);
            }
        }
    }

    /**
     * This check role of user and redirect to page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @author Rangga Darmajati <WA: 085721731478>
     */
    public function RedirectToRole($roles)
    {
        if($roles == 'Admin'){
            return $this->PageAdmin();
        }else{
            return $this->PageHome();
        }
    }

    /**
     * This for Page Admin
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @author Rangga Darmajati <WA: 085721731478>
     */
    public function PageAdmin()
    {
        // \Session::flash('success_authenticate', 'anda berhasil login, selamat datang!');
        return redirect()->route('admin.index');
        // return response()->json(['success'=> true, 'message'=> 'authenticate success' ], 200);
    }

    /**
     * This for Page Home
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @author Rangga Darmajati <WA: 085721731478>
     */
    public function PageHome()
    {
        \Session::flash('success_authenticate', 'anda berhasil login, selamat datang!');
        return redirect()->route('home');
    }

    /**
     * This for Logout
     */
    public function logout()
    {
        session()->invalidate();
        $logout = Sentinel::logout();
        if($logout){
            \Session::flash('success_logout', 'anda berhasil logout');
            return redirect()->back();
        }   
    }

    /**
     * This for Logout
     */
    public function admin_logout()
    {
        session()->invalidate();
        $logout = Sentinel::logout();
        if($logout){
            \Session::flash('success_logout', 'anda berhasil logout');
            return redirect()->route('home');
        }   
    }

    /**
     * this function for forgot_password
     */
    public function forgot_password(Request $request)
    {
        $email = $request->email;
        $str_random = str_random(8);
        $cek_mail = \App\User::where('email', $email)->first();
        if($cek_mail){
            $credentials = [
                'email' => $email
            ];
            $cek_user = Sentinel::findByCredentials($credentials);
            $name = $cek_user->first_name.' '.$cek_user->last_name;
            try{
                $subject = "Permintaan reset password !";
                Mail::send('mails.reset_password', ['name' => $name, 'new_password' => $str_random ],
                    function($mail) use ($email, $name, $subject){
                    $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
            }catch (\Exception $e){
            //Return with error
            $error_message = $e->getMessage();
                return redirect()->back()->with(['error-login' => $error_message]);
            }
                $update_pwd = Sentinel::update($cek_user, [
                    'password' => $str_random
                ]);
                return redirect()->back()->with(['success_authenticate' => 'Permintaan reset password berhasil silahkan cek email anda!']);
        }else{
            return redirect()->back()->with(['error-login' => 'Email tidak terdaftar di echakids.com']);
        }
    }
}
