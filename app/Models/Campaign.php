<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends BaseModel {

    protected $guarded = [];

    public function prepared_offer()
    {
        return $this->belongsTo('App\Models\PreparedOffer');
    }

    public function ips()
    {
        return $this->belongsToMany('App\Models\Ip');
    }
}
