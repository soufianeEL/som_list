<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends BaseModel {

    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }


}
