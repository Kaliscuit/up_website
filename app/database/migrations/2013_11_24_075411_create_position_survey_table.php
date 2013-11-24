<?php

use Illuminate\Database\Migrations\Migration;

class CreatePositionSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('position_survey', function($table)
        {
            $table->increments('id');
            $table->integer('pid')->index();
            $table->integer('sid')->index();
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
        Schema::drop('position_survey');
	}

}