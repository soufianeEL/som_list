<?php namespace App\Models;

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

    public function queues()
    {
        return $this->hasMany('App\Models\Queue');
    }

    public function send($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn){
        $this->queues()->create([
            'payload'       => "$vmta| $from| $subject| $headers| $message| $msg_vmta| $msg_conn",
            'after'         => 10,
        ]);
        //$this->status = "sent";
        //$this->save();
    }
}
