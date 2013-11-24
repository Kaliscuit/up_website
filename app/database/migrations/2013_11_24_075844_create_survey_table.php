<?php

use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('survey', function($table)
        {
            $table->increments('id');
            $table->integer('pid')->index();
            $table->integer('q_01')->default(0)->index();
            $table->integer('q_02')->default(0)->index();
            $table->integer('q_03')->default(0)->index();
            $table->integer('q_04')->default(0)->index();
            $table->integer('q_05')->default(0)->index();
            $table->integer('q_06')->default(0)->index();
            $table->integer('q_07')->default(0)->index();
            $table->integer('q_08')->default(0)->index();
            $table->integer('q_09')->default(0)->index();
            $table->integer('q_10')->default(0)->index();
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
		Schema::drop('survey');
	}

}