<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserPositionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_position', function($table)
        {
            $table->increments('id');
            $table->integer('uid')->unique();
            $table->integer('pid')->index();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('user_position');
	}

}