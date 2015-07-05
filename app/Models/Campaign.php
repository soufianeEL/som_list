<?php namespace App\Models;

use App\Commands\Process;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Campaign extends BaseModel {

    protected $guarded = [];

    public function scopeOfThisUser($query)
    {
        return $query->where('created_by',Auth::user()->id);
    }

    /////////////////// relations //////////////////////
    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
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



    /////////////////// helpers //////////////////////
    public function lastMessage(){
        return $this->messages->last();
    }

    public function lastParam()
    {
        return $this->params->last();
    }

    public function subject()
    {
        return Subject::find($this->subject_id);
    }
    public function from()
    {
        return FromLine::find($this->from_line_id);
    }
    public function creative()
    {
        return Creative::find($this->creative_id);
    }

    public function send($fraction, $vmta, $from, $subject, $headers, $message, $msg_vmta, $delay){
        $queue = $this->queue;
        $payload = "$vmta|$from|$subject|$headers|$message|$msg_vmta|$delay|$fraction";

        if($queue){
            $queue->payload = $payload;
            $queue->after = 21;
            $queue->save();
        }
        else{
            $this->queue()->create([
                'payload'       => $payload,
                'after'         => 10,
            ]);
        }
    }


}
