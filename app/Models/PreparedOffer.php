<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class PreparedOffer extends BaseModel {

    protected $guarded = [];

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }
    // to use 'hasthrout' later
    public function subject(){
        return Subject::find($this->subject_id);
    }
    public function from(){
        return FromLine::find($this->from_line_id);
    }
    public function creative(){
        return Creative::find($this->creative_id);
    }


    public function campaigns()
    {
        return $this->hasMany('App\Models\Campaign');
    }
}
