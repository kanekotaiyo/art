<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
        'startplase',
        'endplase',
        'time',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getPaginateByLimit(int $user_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function getPaginateByLimit2(int $user_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->where('user_id','<>',$user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}