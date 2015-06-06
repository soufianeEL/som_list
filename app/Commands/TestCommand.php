<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class TestCommand extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

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
        file_put_contents('testcommand.txt','job started : '. date('Y-m-d-h:i:s') . PHP_EOL, FILE_APPEND );
        echo 'job starts '.PHP_EOL;
        sleep(10);
        echo 'job ends '.PHP_EOL;
        file_put_contents('testcommand.txt','it works! time : '. date('Y-m-d-h:i:s') . PHP_EOL, FILE_APPEND );
	}

}
