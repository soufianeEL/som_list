<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('name',50);
            $table->text('description');
            $table->integer('code');
            $table->string('vertical',50);
            $table->string('price_format',50);
            $table->string('price_range',50);
            $table->string('sup_list',100); //Suppression list
            $table->string('unsub_link',100); //Unsubscribe Link
            $table->boolean('active')->default(true);
            $table->integer('affiliate_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});

        Schema::table('offers', function(Blueprint $table) {
            $table->foreign('affiliate_id')->references('id')->on('affiliates')
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
		Schema::drop('offers');
	}

}
