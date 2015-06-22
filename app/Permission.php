<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    public $timestamps = false;

    /**
     * roles() many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

}
