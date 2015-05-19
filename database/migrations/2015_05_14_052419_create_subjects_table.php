<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subjects', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('name',255);
            $table->integer('offer_id')->unsigned();

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});

        Schema::table('subjects', function(Blueprint $table) {
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
		Schema::drop('subjects');
	}

}
