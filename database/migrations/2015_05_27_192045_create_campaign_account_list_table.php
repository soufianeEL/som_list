<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignAccountListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_account_list', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('campaign_id')->unsigned();
            $table->integer('list_id')->unsigned();
		});

        Schema::table('campaign_account_list', function(Blueprint $table) {
            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('campaign_account_list', function(Blueprint $table) {
            $table->foreign('list_id')->references('id')->on('account_lists')
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
		Schema::drop('campaign_account_list');
	}

}
