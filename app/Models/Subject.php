<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends BaseModel {

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
    }

    /**
     * One to Many relation
     */
    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

}
