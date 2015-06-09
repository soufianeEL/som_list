<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\User;

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
            'password' => Hash::make('admin')
        ]);

        User::create([
            'name' => 'soufiane2',
            'email' => 'soufianeelhamchi@hotmail.com',
            'password' => Hash::make('user')
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
