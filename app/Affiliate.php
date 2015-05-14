<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model {

    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function offers()
    {
        return $this->hasMany('App\Offer');
    }


}
