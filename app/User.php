<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
//    public function getJWTIdentifier()
//    {
//        return $this->getKey();
//    }
//
//    /**
//     * Return a key value array, containing any custom claims to be added to the JWT.
//     *
//     * @return array
//     */
//    public function getJWTCustomClaims()
//    {
//        return [];
//    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function isAdmin() :bool
    {
        return $this->role->code === 'admin';
    }
    public function is($role){
        return $this->role->code === $role;
    }
}
