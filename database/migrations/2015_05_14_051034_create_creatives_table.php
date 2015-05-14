<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('creatives', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('name',50);
            $table->string('unique_link',255);
            $table->text('html_code');
            $table->string('image',100);
            $table->integer('offer_id')->unsigned();

            $table->timestamps();
		});

        Schema::table('creatives', function(Blueprint $table) {
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
		Schema::drop('creatives');
	}

}
