<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends BaseModel {

    protected $guarded = [];

    /**
     * One to Many relation
     */
    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

}
