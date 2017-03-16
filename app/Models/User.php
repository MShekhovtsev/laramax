<?php

namespace App\Models;

use App\Models\Master\MasterUser;
use Illuminate\Notifications\Notifiable;

class User extends MasterUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /* Access control */
    public function roles(){
        return $this->hasMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole($role){
        return $this->roles()->whereIn('slug', (array) $role)->count();
    }

    public function can($action){
        $user_permission = $this->permissions()->whereSlug($action)->first();

        if($user_permission){
            return (boolean) $user_permission->allow;
        }

        foreach ($this->roles as $role) {
            if($role->can($action)){
                return true;
            }
        }

        return false;
    }

    public function cant($action){
        return !$this->can($action);
    }

    public function cannot($action){
        return $this->cant($action);
    }

    public function allow($action){
        $permission = Permission::whereSlug($action)->first();

        if($permission){
            $user_permission = $this->permissions()->find($permission->id);

            if($user_permission){
                $this->permissions()->updateExistingPivot($permission->id, ['allow' => 1]);
            } else {
                $this->permissions()->attach($permission->id, ['allow' => 1]);
            }
        }
    }

    public function deny($action){
        $permission = Permission::whereSlug($action)->first();

        if($permission){
            $user_permission = $this->permissions()->find($permission->id);

            if($user_permission){
                $this->permissions()->updateExistingPivot($permission->id, ['allow' => 0]);
            } else {
                $this->permissions()->attach($permission->id, ['allow' => 0]);
            }
        }
    }

}