<?php

use Illuminate\Database\Seeder;
use App\Models\Server; use App\Models\Ip;

class ServerIpTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('servers')->delete();

        for($j =1; $j < 4; $j++){
            $server = new Server();
            $server->name = 'server-'.$j;
            $server->main_ip = '0.0.'.$j.'.0';
            $server->active = true;
            $server->save();
            for($i =1; $i < 4; $i++){
                $ip = new Ip();
                $ip->domain = 'domain-'.$i;
                $ip->ip = '0.0.'.$j.'.'.$i;
                $ip->server_id = $j;
                $ip->save();
            }
        }

        Server::create([
            'name' => 'server-last',
            'main_ip' => '1.1.1.1',
            'active' => false,

        ]);

    }
}