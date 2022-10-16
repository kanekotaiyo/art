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
        'allfinish',
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
        $yesterday = date("Y-m-d H:i:s",strtotime('-1 day'));
        //dd($yesterday);
        return $this->where('time','>',$yesterday)->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByLimitAllreserve(int $user_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        $matched_reserve=Matching::where("confirmed",'=',1)->get(["reserve_id"]);
        $array=[];
        foreach($matched_reserve as $match_reserve){
            array_push($array,$match_reserve->reserve_id);
        }
        //dd($array);
        $today = date("Y-m-d H:i:s");
        //dd($today);
        return $this->whereNotIn('id',$array)->where('time','>',$today)->where('user_id','<>',$user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByLimitPastuse(int $user_id,int $limit_count = 10)
    {
        return $this->where('allfinish','=',1)->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
}