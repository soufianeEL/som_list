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

    public function params()
    {
        return $this->hasMany('App\Models\Params');
    }

    public function queue()
    {
        return $this->hasOne('App\Models\Queue');
    }

    ///////////////////
    public function offer(){
        return $this->prepared_offer->offer();
    }

    public function subject(){
        return $this->prepared_offer->subject();
    }

    public function from(){
        return $this->prepared_offer->from();
    }

    public function creative(){
        return $this->prepared_offer->creative();
    }

    public function lastMessage(){
        return $this->messages->last();
    }

    public function lastParam()
    {
        return $this->params->last();
    }

    public function send($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn){
        $queue = $this->queue();
        if($queue->first()){
            $this->queue->payload = "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn";
            $this->queue->after = 21;
            $this->queue->save();
        }
        else{
            $queue->create([
                'payload'       => "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn",
                'after'         => 10,
            ]);
        }
    }

    public  function pause_job(){
        $queue = $this->queue()->first();
        if($queue){
            return Process::kill($queue->pid);
        }
        return false;
    }

    public  function resume_job(){
        return 'ok from resume';
    }

//    public static function boot()
//    {
//        parent::boot();
//        static::created(function($model)
//        {
//            die('created');
//        });
//        static::updated(function($model)
//        {
//            die('update');
//        });
//    }

}
