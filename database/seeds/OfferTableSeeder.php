<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 14/05/2015
 * Time: 15:42
 */

use Illuminate\Database\Seeder;


class OfferTableSeeder extends Seeder {

    public function run()
    {

        DB::table('offers')->delete();
        $now = new DateTime;
        $d = "description for offer";

        $offers = array(
            ['name' => 'offer 1', 'code' => '10','description' => $d,'vertical' => 'sport','active' => true, 'affiliate_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'offer 2', 'code' => '20','description' => $d,'vertical' => 'auto','active' => true, 'affiliate_id' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'offer 3', 'code' => '30','description' => $d,'vertical' => 'auto','active' => false, 'affiliate_id' => '2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'offer 4', 'code' => '40','description' => $d,'vertical' => 'life','active' => true, 'affiliate_id' => '2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'offer 5', 'code' => '50','description' => $d,'vertical' => 'life','active' => true, 'affiliate_id' => '2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'offer 6', 'code' => '60','description' => $d,'vertical' => 'sport','active' => false, 'affiliate_id' => '2', 'created_at' => $now, 'updated_at' => $now],

        );

//        DB::table('offers')->insert($offers);
        for($i=1; $i<2;$i++){
            foreach ( $offers as $offer ){
                \App\Models\Offer::create($offer);
            }

        }
    }

}