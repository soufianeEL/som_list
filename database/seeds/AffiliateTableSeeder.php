<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 14/05/2015
 * Time: 15:27
 */

use Illuminate\Database\Seeder;


class AffiliateTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('affiliates')->delete();

        $affiliates = array(
            ['name' => 'aff 1', 'code' => '10','link' => 'www.aff_1','status' => 'active', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'aff 2', 'code' => '20','link' => 'www.aff_2','status' => 'active', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'aff 3', 'code' => '30','link' => 'www.aff_3','status' => 'inactive', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('affiliates')->insert($affiliates);
    }

}