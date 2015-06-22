<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\User;
use \App\Role;
use \App\Permission;
use \App\PermissionRole;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        DB::table('users')->delete();

        User::create([
            'name' => 'soufiane',
            'email' => 'soufianeelhamchi@gmail.com',
            'password' => Hash::make('admin'),
            'role_id' => 4
        ]);

        User::create([
            'name' => 'soufiane2',
            'email' => 'soufianeelhamchi@hotmail.com',
            'password' => Hash::make('user'),
            'role_id' => 1
        ]);

        $tmp = ['Mailer','Sup','Offer Manager','Administrator'];
        $tmp2 = ['mailer','sup','offer_m','admin'];
        for($i=0; $i < 4;$i++){

            Role::create([
                'title' => $tmp[$i],
                'slug' => $tmp[$i]
            ]);
        }

        $tmp3 = ['affiliates','offers','servers','ips','lists','campaigns','users'];
        for($i=0; $i < 7;$i++){

            Permission::create([
                'title' => 'crud in ' . $tmp3[$i],
                'slug' => $tmp3[$i]
            ]);
        }



        // $this->call('UserTableSeeder');
        $this->call('AffiliateTableSeeder');
        $this->call('OfferTableSeeder');
        $this->call('ChildOfferTableSeeder');
        $this->call('ServerIpTableSeeder');
        $this->call('PreparedOfferTableSeeder');
        $this->call('AccountListTableSeeder');

	}

}
