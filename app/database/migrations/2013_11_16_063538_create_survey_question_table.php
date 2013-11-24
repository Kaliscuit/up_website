<?php

use Illuminate\Database\Migrations\Migration;

class CreateSurveyQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('survey_question', function($table)
        {
            $table->increments('id');
            $table->text('question');
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
        Schema::drop('survey_question');
	}

}