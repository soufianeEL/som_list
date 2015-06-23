<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Params extends Model {

    public $timestamps = false;

    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }


}
