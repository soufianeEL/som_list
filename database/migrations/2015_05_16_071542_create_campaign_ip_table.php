<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignIpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_ip', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('campaign_id')->unsigned();
            $table->integer('ip_id')->unsigned();

		});

        Schema::table('campaign_ip', function(Blueprint $table) {
            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('campaign_ip', function(Blueprint $table) {
            $table->foreign('ip_id')->references('id')->on('ips')
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
		Schema::drop('campaign_ip');
	}

}
