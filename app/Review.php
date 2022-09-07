<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function reviewingUser()
    {
        return $this->belongsTo('App\User','reviewing_id');
    }
    public function reviewedUser()
    {
        return $this->belongsTo('App\User','reviewed_id');
    }
}
