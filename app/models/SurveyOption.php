<?php

/**
 * Class SurveyOption
 *
 * @property id               $id
 * @property option           $option
 * @property score            $score
 * @property qid              $qid
 */
class SurveyOption extends Eloquent {
    protected $table = 'survey_option';
}