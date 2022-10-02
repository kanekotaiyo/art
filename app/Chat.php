<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Matching;

class Chat extends Model
{
    protected $fillable = [
        'to_id',
        'from_id',
        'matching_id',
        'message',
    ];
    
    public function toUser()
    {
        return $this->belongsTo('App\User','to_id');
    }
    public function fromUser()
    {
        return $this->belongsTo('App\User','from_id');
    }
    public function Matching()
    {
        return $this->belongsTo('App\Matching');
    }
    
    public function getPaginateByLimitChat(int $matching_id,int $limit_count = 10)
    {
        return $this->where('matching_id',$matching_id)->orderBy('updated_at', 'ASC')->paginate($limit_count);
    }
}
