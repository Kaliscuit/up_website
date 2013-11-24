<?php

use Illuminate\Database\Migrations\Migration;

class CreateSurveyOptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('survey_option', function($table)
        {
            $table->increments('id');
            $table->text('option');
            $table->integer('score');
            $table->integer('qid')->index();
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
		Schema::drop('survey_option');
	}

}