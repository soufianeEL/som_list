<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\User;
use \App\Role;

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

        Role::create([
            'name' => 'mailer'
        ]);
        Role::create([
            'name' => 'sup'
        ]);
        Role::create([
            'name' => 'offer manager'
        ]);
        Role::create([
            'name' => 'admin'
        ]);Role::create([
            'name' => 'admin'
        ]);


        // $this->call('UserTableSeeder');
        $this->call('AffiliateTableSeeder');
        $this->call('OfferTableSeeder');
        $this->call('ChildOfferTableSeeder');
        $this->call('ServerIpTableSeeder');
        $this->call('PreparedOfferTableSeeder');
        $this->call('AccountListTableSeeder');

	}

}
