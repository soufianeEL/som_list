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

        User::create([
            'name' => 'soufiane',
            'email' => 'soufianeelhamchi@gmail.com',
            'password' => Hash::make('admin')
        ]);

        // $this->call('UserTableSeeder');
        $this->call('AffiliateTableSeeder');
        $this->call('OfferTableSeeder');
        $this->call('ChildOfferTableSeeder');

	}

}
