<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'reviewing_id',
        'reviewed_id',
        'review',
        'comment',
        'matching_id',
    ];
    public function reviewingUser()
    {
        return $this->belongsTo('App\User','reviewing_id');
    }
    public function reviewedUser()
    {
        return $this->belongsTo('App\User','reviewed_id');
    }
    public function Matching()
    {
        return $this->belongsTo('App\Matching');
    }
}
