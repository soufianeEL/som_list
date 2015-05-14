<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model {

    protected $guarded = [];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function affiliate()
    {
        return $this->belongsTo('App\Affiliate');
    }

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
    public function fromLines()
    {
        return $this->hasMany('App\FromLine');
    }
    public function creatives()
    {
        return $this->hasMany('App\Creative');
    }

}
