<?php namespace app\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->created_by = User::all()->count();
            $model->updated_by = User::all()->count();
        });
        static::updating(function($model)
        {
            $model->updated_by = User::all()->count();
        });

        static::deleting(function($model)
        {
            //$model->updated_by = Auth::user()->count();
            $model->save();
        });
    }


}