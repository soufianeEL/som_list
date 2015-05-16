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
            $id_user = ( $tmp ? $tmp->id : 0);
            $model->created_by = $id_user;
            $model->updated_by = $id_user;
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