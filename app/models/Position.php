<?php

/**
 * Class Position
 *
 * @property int              $int
 * @property url              $url
 * @property position         $position
 * @property position_desc    $position_desc
 * @property company          $company
 * @property company_desc     $company_desc
 * @property company_address  $company_address
 * @property company_homepage $company_homepage
 * @property time             $time
 */
class Position extends Eloquent {

    protected $table = 'zhaopin';
    protected $timestamps = false;

}