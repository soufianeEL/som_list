<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFromLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('from_lines', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('from',255);
            $table->integer('offer_id')->unsigned();

            $table->timestamps();
		});

        Schema::table('from_lines', function(Blueprint $table) {
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
		Schema::drop('from_lines');
	}

}
