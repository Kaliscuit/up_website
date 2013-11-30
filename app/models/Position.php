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
 * @property click_times      $click_times
 * @property rank             $rank
 * @property hot              $hot
 * @property time             $time
 */
class Position extends Eloquent {

    protected $table = 'zhaopin';
    public $timestamps = false;

    public function getRankAttribute() {
        return $this->newQuery()->where('click_times', '>', $this->click_times)->count() + 1;
    }

    public function toArray() {
        return [
            'id'            => $this->id,
            'position'      => $this->position,
            'position_desc' => $this->position_desc,
            'requirements'  => $this->requirements,
            'hot'           => $this->hot,
            'rank'          => $this->rank
        ];
    }

}
