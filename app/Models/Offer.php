<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends BaseModel {

    protected $guarded = [];

    /**
     * One to Many relation
     */
    public function affiliate()
    {
        return $this->belongsTo('App\Models\Affiliate');
    }
    /**
     * One to Many relation
     */
    public function campaigns() //  should be has_one ??
    {
        return $this->hasMany('App\Models\Campaign');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }
    public function from_lines()
    {
        return $this->hasMany('App\Models\FromLine');
    }
    public function creatives()
    {
        return $this->hasMany('App\Models\Creative');
    }

//    public function prepared_offers()
//    {
//        return $this->hasMany('App\Models\PreparedOffer');
//    }

}
