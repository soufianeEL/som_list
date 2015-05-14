<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model {

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }


}
