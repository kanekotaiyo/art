<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','car','comment','image_path'
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
    
    public function matchings()
    {
        return $this->hasMany('App\Matching');  
    }
    
    public function reviewing()
    {
        return $this->hasMany('App\Review','reviewing_id');  
    }
    
    public function reviewed()
    {
        return $this->hasMany('App\Review','reviewed_id');  
    }
    
    public function to()
    {
        return $this->hasMany('App\Chat','to_id');  
    }
    
    public function from()
    {
        return $this->hasMany('App\Chat','from_id');  
    }
}
