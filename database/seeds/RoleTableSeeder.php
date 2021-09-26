<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
        		[
        			'slug' => 'adm',
        			'name' => 'Admin',
        			'permissions' => '{ "home":true, "product":true, "shop":true, "product/create":true, "product/edit":true, "product/delete":true, "contact":true, "contact/create":true, "contact/edit":true }',
        		],
        		[
        			'slug' => 'usr',
        			'name' => 'User',
        			'permissions' => '{ "home":true, "product":true, "shop":true, "product/create":false, "product/edit":false, "product/delete":false, "contact":true, "contact/create":false, "contact/edit":false }',
        		],
        	);

        foreach( $roles as $data )
        {
        	Roles::firstOrCreate($data);
        }
    }
}
