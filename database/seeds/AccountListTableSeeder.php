<?php


use Illuminate\Database\Seeder;
use App\Models\AccountList;
use App\Models\CampaignAccountList;

class AccountListTableSeeder extends Seeder {

    public function run()
    {
        $tmp=["gmail","yahoo","aol"];
        $tmp2=["HB","FRESH","MAGIC"];
        $t = [0,1,2,1,0,2];

        for($j =1; $j < 6; $j++){
            $i = $t[$j-1];
            AccountList::create([
                'name' => 'list-'.$j ,
                'isp' => $tmp[$i],
                'type' => $tmp2[$i],
//                'created_by' => 1
            ]);
        }

        for($i =1; $i < 6; $i++) {
            for ($j = 1; $j < 3; $j++) {
                CampaignAccountList::create([
                    'campaign_id' => $i,
                    'list_id' => $j,
                ]);
            }
        }



    }
}