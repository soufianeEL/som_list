<?php namespace App\Models;

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

        static::saving(function($model)
        {
            $model->attempts++;
            self::process($model);
        });
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

    public static function process($model)
    {
        $process_id = Process::run("send.php \"{$model->payload}\" \"{$model->campaign_id}\" $model->return");
        $model->pid = $process_id;
        $model->status = 0;
    }

    public function pause()
    {
        Process::kill($this->pid);
    }

    public function resume()
    {
        $this->save();
    }
}
