<?php

/**
 * Class Position
 *
 * @property id               $id
 * @property url              $url
 * @property position         $position
 * @property position_desc    $position_desc
 * @property requirements     $requirements
 * @property company          $company
 * @property company_desc     $company_desc
 * @property company_address  $company_address
 * @property company_homepage $company_homepage
 * @property time             $time
 */
class Position extends Eloquent {

    protected $table = 'zhaopin';
    public $timestamps = false;

}