<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model {

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
        return $this->hasMany('App\Models\Subject');
    }
    public function fromLines()
    {
        return $this->hasMany('App\Models\FromLine');
    }
    public function creatives()
    {
        return $this->hasMany('App\Models\Creative');
    }

}
