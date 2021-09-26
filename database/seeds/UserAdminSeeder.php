<?php

use Illuminate\Database\Seeder;
use Sentinel;
use UserRole;
class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$credentials = [
    		'email' => 'dummyadministrator@mailinator.com'
        	,'password' => 'password'
        	,'permissions' => '{"admin":true}'
        	,'first_name' => 'DummyAdmin'
        	,'last_name' => 'Istrator'
    	];

    	$credentials_validation = [
    		'email' => 'dummyadministrator@mailinator.com'
        	,'password' => 'password'
    	];

    	$user_validation = Sentinel::validForCreation($credentials_validation);

    	if ($user_validation){
    		
        	$user = Sentinel::registerAndActivate($credentials);
        	UserRole::create(['user_id' => $user->id, 'role_id' => 1]);
    	}




    }
}
