<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Matching;

class Reserve extends Model
{
    //use SoftDeletes;
    
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
    
    public function matchings()
    {
        return $this->hasMany('App\Matching');  
    }
    
    public function getPaginateByLimitMyreserve(int $user_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByLimitAllreserve(int $user_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        $matched=Matching::where("confirmed",'=',1)->get(["reserve_id"]);
        $array=[];
        foreach($matched as $match){
            array_push($array,$match->reserve_id);
        }
        //dd($array);
        return $this->whereNotIn('id',$array)->where('user_id','<>',$user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}