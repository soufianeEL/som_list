<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function ips()
    {
        return $this->hasMany('App\Models\Ip');
    }

}
