<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name',50);
            $table->string('status',20); // to set to ENUM (sent, active, paused, draft)
            $table->string('type',20); // to set to ENUM (mixte)
            $table->integer('offer_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('creative_id')->unsigned();
            $table->integer('from_line_id')->unsigned();
            //$table->integer('prepared_offer_id')->unsigned();
            //id_liste
            //id_message

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});

        Schema::table('campaigns', function(Blueprint $table) {
            $table->foreign('offer_id')->references('id')->on('offers')
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
		Schema::drop('campaigns');
	}

}
