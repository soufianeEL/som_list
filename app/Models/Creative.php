<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creative extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    /**
     * One to Many relation
     */
    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

}
