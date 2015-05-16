<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreparedOffer extends BaseModel {

    protected $guarded = [];

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\Campaign');
    }
}
