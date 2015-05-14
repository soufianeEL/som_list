<?php


use Illuminate\Database\Seeder;
use App\Subject;use App\FromLine; use App\Creative;

class ChildOfferTableSeeder extends Seeder {

    public function run()
    {

        for($j =1; $j < 6; $j++){
            for($i =1; $i < 4; $i++){
                Subject::create([
                    'name' => 'subject-'.$i ,
                    'offer_id' => $j
                ]);
            }

            for($i =1; $i < 3; $i++){
                Creative::create([
                    'name' => 'subject '.$i ,
                    'unique_link' => 'www.crea-'.$i.'.jpg' ,
                    'offer_id' => $j
                ]);
            }

            for($i =1; $i < 4; $i++){
                FromLine::create([
                    'from' => 'from '.$i ,
                    'offer_id' => $j
                ]);
            }

        }





    }

}