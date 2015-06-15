<?php namespace App\Models;

use App\Commands\Nohup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model {

    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        static::created(function($model)
        {
            $nuhup = New Nohup("send.php \"{$model->payload}\" \"{$model->id}\"");
            //$nuhup = New Nohup("send.php");
            $nuhup->run();
            $model->pid = $nuhup->pid;
            $model->status = 0;
            $model->save();
            //unset($nuhup);
        });
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

}
