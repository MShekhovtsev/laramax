<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /* Access control */
    public function users(){
        return $this->hasMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function can($action){
        $permission = $this->permissions()->whereSlug($action)->first();

        return (bool) $permission;
    }

    public function cant($action){
        return !$this->can($action);
    }

    public function cannot($action){
        return $this->cant($action);
    }

    public function allow($action){
        $permission = Permission::whereSlug($action)->first();

        if(!$this->can($action)){
            $this->permissions()->attach($permission->id);
        }
    }

    public function deny($action){
        $permission = Permission::whereSlug($action)->first();

        if($this->can($action)){
            $this->permissions()->detach($permission->id);
        }
    }
}
