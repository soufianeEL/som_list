<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('params', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('fraction');
            $table->integer('rotation');
            $table->string('delay'); //x-delay
            $table->integer('seed');
            $table->string('lists');
            $table->string('ips');

            $table->integer('campaign_id')->unsigned();
			$table->timestamps();
		});

        Schema::table('params', function(Blueprint $table) {
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
		Schema::drop('params');
	}

}
