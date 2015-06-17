<?php namespace App\Models;

use App\Commands\Nohup;
use App\Commands\Process;
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
            //$nuhup = New Nohup("send.php \"{$model->payload}\" \"{$model->id}\"");
            //$nuhup = New Nohup("send.php");
            die('created');
            $process_id = Process::run("send.php \"{$model->payload}\" \"{$model->id}\"");
            $model->pid = $process_id;
            $model->status = 0;
            $model->save();

//            $nuhup->run();
//            $model->pid = $nuhup->pid;
//            $model->status = 0;
//            $model->save();
            //unset($nuhup);
        });

        static::updated(function($model)
        {
            die('update');
            $model->after = $model->after + 22;
            $model->save();
        });
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

}
