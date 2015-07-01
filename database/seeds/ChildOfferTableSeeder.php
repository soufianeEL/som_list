<?php


use Illuminate\Database\Seeder;
use App\Models\Subject;use App\Models\FromLine; use App\Models\Creative;

class ChildOfferTableSeeder extends Seeder {

    public function run()
    {

        for($j =1; $j < 6; $j++){
            for($i =1; $i < 3; $i++){
                Subject::create([
                    'name' => 'subject-'.$i*$j ,
                    'offer_id' => $j
                ]);
            }

            for($i =1; $i < 3; $i++){
                Creative::create([
                    'name' => 'creative '.$i*$j ,
                    'unique_link' => 'www.crea-'.$i.'.jpg' ,
                    'offer_id' => $j
                ]);
            }

            for($i =1; $i < 3; $i++){
                FromLine::create([
                    'from' => 'from '.$i*$j ,
                    'offer_id' => $j
                ]);
            }

        }


    }

}