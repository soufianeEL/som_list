<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreparedOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prepared_offers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('creative_id')->unsigned();
            $table->integer('from_line_id')->unsigned();

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});

        Schema::table('prepared_offers', function(Blueprint $table) {
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
		Schema::drop('prepared_offers');
	}

}
