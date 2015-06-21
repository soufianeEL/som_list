<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //protected $guarded = [];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function getRole(){
        return $this->role->name;
    }

    public function isAdmin(){
        return $this->role->name == 'admin';
    }

    public function isSup(){
        return $this->role->name == 'sup';
    }

    public function isOfferManager(){
        return $this->role->name == 'offer manager';
    }

    public function isMailer(){
        return $this->role->name == 'mailer';
    }


}
