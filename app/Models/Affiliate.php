<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    /**
     * One to Many relation
     */
    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }


}
