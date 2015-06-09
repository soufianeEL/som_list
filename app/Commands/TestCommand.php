<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class TestCommand extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    //protected $job;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $rand = rand(0, 100);
        $start = 'job '.$rand.' starts : '. date('Y-m-d-h:i:s') . PHP_EOL;
        file_put_contents('testcommand.txt','f** '. $start, FILE_APPEND );
        echo 'TC** '.$start;
        sleep(20);
        $end = 'it works! '.$rand.' : '. date('Y-m-d-h:i:s') . PHP_EOL;
        echo 'TC** '.$end;
        file_put_contents('testcommand.txt','f** ' .$end, FILE_APPEND );


	}

}
