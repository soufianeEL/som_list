<?php namespace app\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //static $id_user = Auth::user()->id;
    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $tmp = Auth::user();
            if($tmp){
                $model->created_by = $tmp->id;
                $model->updated_by = $tmp->id;
            }
            else{
                $model->created_by = 1;
            }

        });
        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;
        });

        static::deleting(function($model)
        {
            $model->updated_by = Auth::user()->id;
            $model->save();
        });
    }


}