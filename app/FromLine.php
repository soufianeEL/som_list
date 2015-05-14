<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FromLine extends Model {

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
