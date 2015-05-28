<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountList extends BaseModel {

    protected $guarded = [];

    public function campaigns()
    {
        return $this->belongsToMany('App\Models\Campaign','campaign_account_list', 'campaign_id', 'list_id');
    }

}
