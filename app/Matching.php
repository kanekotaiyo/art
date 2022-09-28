<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class Matching extends Model
{
    //use SoftDeletes;
    
    protected $fillable = [
        'reserve_id',
        'user_id',
        'confirmed',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function reserve()
    {
        return $this->belongsTo('App\Reserve');
    }
    
    public function getPaginateByLimitMatchlist(int $user_id,int $limit_count = 10)
    {
        //$today = date("Y-m-d H:i:s");
        $yesterday = date("Y-m-d H:i:s",strtotime('-1 day'));
        //return $this->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //if($this->confirmed ===1){
            return $this->whereHas('reserve',function($query) use($yesterday){
                $query->where('time','>',$yesterday);
            })->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
        /*}else{
            return $this->whereHas('reserve',function($query) use($today){
                $query->where('time','>',$today);
            })->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }*/
        
    }
    
    public function getPaginateByLimitShow(int $reserve_id,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->where('reserve_id', $reserve_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByLimitChat(int $matchimg,int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return ;
    }
    
    
}
