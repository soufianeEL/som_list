<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creative extends BaseModel {

    protected $guarded = [];

    /**
     * One to Many relation
     */
    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

}
