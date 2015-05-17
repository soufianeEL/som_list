<?php


use Illuminate\Database\Seeder;
use App\Models\PreparedOffer;
use App\Models\Campaign;
use App\Models\CampaignIp;

class PreparedOfferTableSeeder extends Seeder {

    public function run()
    {
        $tmp=[1,2,3];

        for($j =1; $j < 6; $j++){
            $tmp2 = $j%3;
            PreparedOffer::create([
                'offer_id' => $j ,
                'subject_id' => $tmp[$tmp2],
                'creative_id' => $tmp[$tmp2],
                'from_line_id' => $tmp[$tmp2],
//                'created_by' => 1
            ]);
        }

        for($j =1; $j < 6; $j++){
            Campaign::create([
                'name' => 'Campaign-'.$j ,
                'status' => 'draft',
                'type' => 'simple',
                'prepared_offer_id' => $j,
//                'created_by' => 1
            ]);
        }

        for($i =1; $i < 6; $i++) {
            for ($j = 1; $j < 3; $j++) {
                CampaignIp::create([
                    'campaign_id' => $i,
                    'ip_id' => $j,
                ]);
            }
        }



    }
}