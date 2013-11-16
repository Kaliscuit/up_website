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
//            $table->increments('id');
//            $table->

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}