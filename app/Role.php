<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public $timestamps = false;
    //protected $fillable = ['name'];

    /**
     * users() one-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * permissions() many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }



}
