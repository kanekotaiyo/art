<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','car','comment',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function reserves()   
    {
        return $this->hasMany('App\Reserve');  
    }
    public function matches()
    {
        return $this->hasMany('App\Match');  
    }
    public function reviewing()
    {
        return $this->hasMany('App\Review','reviewing_id');  
    }
    public function reviewed()
    {
        return $this->hasMany('App\Review','reviewed_id');  
    }
}
