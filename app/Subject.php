<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

}
