<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip extends BaseModel {


    protected $guarded = [];


    public function server()
    {
        return $this->belongsTo('App\Models\Server');
    }

    public function campaigns()
    {
        return $this->belongsToMany('App\Models\Campaign');
    }


}
