<?php


use Illuminate\Database\Seeder;
use App\Models\PreparedOffer;
use App\Models\Campaign;
use App\Models\CampaignIp;
use App\Models\Message;

class PreparedOfferTableSeeder extends Seeder {

    public function run()
    {
        $tmp=[1,2,3];

//        for($j =1; $j < 6; $j++){
//            $tmp2 = $j%3;
//            PreparedOffer::create([
//                'offer_id' => $j ,
//                'subject_id' => $tmp[$tmp2],
//                'creative_id' => $tmp[$tmp2],
//                'from_line_id' => $tmp[$tmp2],
////                'created_by' => 1
//            ]);
//        }

        for($j =1; $j < 6; $j++){
            $tmp2 = $j%3;
            Campaign::create([
                'name' => 'Campaign-'.$j ,
                'status' => 'draft',
                'type' => 'simple',
                'offer_id' => $j,
                'subject_id' => $tmp[$tmp2],
                'creative_id' => $tmp[$tmp2],
                'from_line_id' => $tmp[$tmp2],
//                'created_by' => 1
            ]);
        }

        for ($i = 1; $i < 3; $i++) {
            for($j =1; $j < 6; $j++){
                $offer = Campaign::find($j, ['id','offer_id'])->offer;
                Message::create([
                    'name' => $offer->name. '__' . date('Y-m-d-h:i:s'),
                    'headers' => "From: soufiane elh <soufiane@good.somsales.com>" . "\n" .
                        "Content-Type: text/plain;",
                    'body' => 'body ' . $i,
                    'campaign_id' => $j
                ]);
            }
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