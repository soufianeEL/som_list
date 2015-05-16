<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends BaseModel {

    protected $guarded = [];

    public function ips()
    {
        return $this->hasMany('App\Models\Ip');
    }

}
