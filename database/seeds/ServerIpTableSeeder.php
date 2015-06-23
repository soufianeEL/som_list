<?php

use Illuminate\Database\Seeder;
use App\Models\Server; use App\Models\Ip;

class ServerIpTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('servers')->delete();

        Server::create([
            'name' => 'server-1',
            'main_ip' => '146.247.24.68',
            'active' => true,
        ]);

        Server::create([
            'name' => 'server-2',
            'main_ip' => '146.247.24.69',
            'active' => true,
        ]);

        Server::create([
            'name' => 'server-3',
            'main_ip' => '146.247.24.91',
            'active' => true,
        ]);

        Server::create([
            'name' => 'server-last',
            'main_ip' => '1.1.1.1',
            'active' => false,

        ]);

        Ip::create([
            'domain' => 'somsales.com',
            'ip' => '146.247.24.68',
            'server_id' => '1',
            'vmta' => 'MTA-146.247.24.68-gmail'
        ]);
        Ip::create([
            'domain' => 'it.somsales.com',
            'ip' => '146.247.24.91',
            'server_id' => '1',
            'vmta' => 'MTA-146.247.24.61-gmail'
        ]);
        Ip::create([
            'domain' => 'mail.somsales.com',
            'ip' => '146.247.24.69',
            'server_id' => '1',
            'vmta' => 'MTA-146.247.24.69-gmail'
        ]);
        Ip::create([
            'domain' => 'shore.somsales.com',
            'ip' => '146.247.24.92',
            'server_id' => '1',
            'vmta' => 'MTA-146.247.24.92-gmail'
        ]);

        //
        Ip::create([
            'domain' => 'somsales.com',
            'ip' => '146.247.24.69',
            'server_id' => '2',
            'vmta' => 'MTA-146.247.24.68-yahoo'
        ]);
        Ip::create([
            'domain' => 'it.somsales.com',
            'ip' => '146.247.24.91',
            'server_id' => '2',
            'vmta' => 'MTA-146.247.24.61-yahoo'
        ]);
        Ip::create([
            'domain' => 'mail.somsales.com',
            'ip' => '146.247.24.92',
            'server_id' => '2',
            'vmta' => 'MTA-146.247.24.69-yahoo'
        ]);
        Ip::create([
            'domain' => 'shore.somsales.com',
            'ip' => '146.247.24.68',
            'server_id' => '2',
            'vmta' => 'MTA-146.247.24.92-yahoo'
        ]);

        //
        Ip::create([
            'domain' => 'somsales.com',
            'ip' => '146.247.24.91',
            'server_id' => '3',
            'vmta' => 'MTA-146.247.24.91-hotmail'
        ]);
        Ip::create([
            'domain' => 'it.somsales.com',
            'ip' => '146.247.24.92',
            'server_id' => '3',
            'vmta' => 'MTA-146.247.24.92-hotmail'
        ]);
        Ip::create([
            'domain' => 'mail.somsales.com',
            'ip' => '146.247.24.68',
            'server_id' => '3',
            'vmta' => 'MTA-146.247.24.68-hotmail'
        ]);
        Ip::create([
            'domain' => 'shore.somsales.com',
            'ip' => '146.247.24.69',
            'server_id' => '3',
            'vmta' => 'MTA-146.247.24.69-hotmail'
        ]);






//        for($j =1; $j < 4; $j++){
//            $server = new Server();
//            $server->name = 'server-'.$j;
//            $server->main_ip = '0.0.'.$j.'.0';
//            $server->active = true;
//            $server->save();
//            for($i =1; $i < 4; $i++){
//                $ip = new Ip();
//                $ip->domain = 'domain-'.$i;
//                $ip->ip = '0.0.'.$j.'.'.$i;
//                $ip->server_id = $j;
//                $ip->save();
//            }
//        }
//
//        Server::create([
//            'name' => 'server-last',
//            'main_ip' => '1.1.1.1',
//            'active' => false,
//
//        ]);

    }
}