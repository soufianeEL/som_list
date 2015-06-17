<?php namespace App\Models;

use App\Commands\Process;
use Illuminate\Database\Eloquent\Model;

class Campaign extends BaseModel {

    protected $guarded = [];

    public function prepared_offer()
    {
        return $this->belongsTo('App\Models\PreparedOffer');
    }

    public function lists()
    {
        return $this->belongsToMany('App\Models\AccountList','campaign_account_list', 'campaign_id', 'list_id');
    }


    public function ips()
    {
        return $this->belongsToMany('App\Models\Ip');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function queue()
    {
        return $this->hasOne('App\Models\Queue');
    }

    public function send($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn){
        $queue = $this->queue();
        if($queue->first()){
            $q = [
                'payload'       => "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn",
                'after'         => 20,
                ];
            $queue->update($q);
        }
        else{
            $queue->create([
                'payload'       => "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn",
                'after'         => 10,
            ]);
        }


//        $tmp = $this->queue()->firstOrCreate([
//            'payload'       => "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn",
//            'after'         => 10,
//        ]);

//
        //$this->status = "sent";
        //$this->save();
    }

    public  function pause(){
        $queue = $this->queue()->first();
        if($queue){
            Process::kill($queue->pid);
        }

    }

    public  function resume(){

    }

    public static function boot()
    {
        parent::boot();

        static::created(function($model)
        {
            die('created');
        });

        static::updated(function($model)
        {
            die('update');
        });
    }
}
