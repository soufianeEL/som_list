<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_lists', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name',50);
            $table->string('isp',50);
            $table->string('type',50);
            $table->text('description');
            $table->dateTime('add_date');
            $table->boolean('active')->default(true);

            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('account_lists');
	}

}
