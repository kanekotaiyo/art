<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function toUser()
    {
        return $this->belongsTo('App\User','to_id');
    }
    public function fromUser()
    {
        return $this->belongsTo('App\User','from_id');
    }
}
