<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queues', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('payload');
            $table->integer('after')->default(null);
            $table->integer('pid');
            $table->integer('status')->default(-1); // 0 sending, 1 sent successfully, !! 2 paused
            $table->integer('return')->default(0);

            $table->integer('campaign_id')->unsigned();
            $table->softDeletes();
		});

        Schema::table('queues', function(Blueprint $table) {
            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queues');
	}

}
