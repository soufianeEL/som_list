<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ips', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('domain',100);
            $table->string('ip',20);
            $table->string('vmta',30);
            $table->boolean('active')->default(true);
            $table->integer('server_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
		});

        Schema::table('ips', function(Blueprint $table) {
            $table->foreign('server_id')->references('id')->on('servers')
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
		Schema::drop('ips');
	}

}
