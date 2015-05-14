<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }
    public function FromLines()
    {
        return $this->hasMany('App\Models\FromLine');
    }
    public function creatives()
    {
        return $this->hasMany('App\Models\Creative');
    }

}
