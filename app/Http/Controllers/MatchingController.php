<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use App\Matching;
use App\Review;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    //マッチングを申請しmatchingテーブルに格納
    public function matching(Reserve $reserve, Matching $matching)
    {
        $user_id=Auth::id();
        $is_matching=$matching->where('reserve_id', $reserve->id)->where('user_id',$user_id)->first();
        if(isset($is_matching)){
            return redirect('/matchlist');
        }else{
            $input=[
                'reserve_id'=>$reserve->id,
                'user_id'=>Auth::id(),
                'confirmed'=>0,
            ];
            $matching->fill($input)->save();
            return redirect('/matchlist');
        }
    }
    
    //マッチング申請リストに移動
    public function matchlist(Matching $matching)
    {
        return view('matchlist')->with(['matchings' => $matching->getPaginateByLimitMatchlist(Auth::id())]);
    }
    
    //マッチング状況に移動
    public function show(Reserve $reserve, Matching $matching)
    {
        $today = date("Y-m-d H:i:s");
        $reserve_id=$reserve->id;
        $user_id=Auth::id();
        if ($reserve->user_id==$user_id){
            return view('show')->with(['matchings' => $matching->getPaginateByLimitShow($reserve_id), 'reserve' => $reserve, 'today' => $today]);
        }else{
            return redirect('/myreserve');
        }
    }
    
    //マッチングを予約者側が確定させる
    public function matching_confirm(Reserve $reserve, Matching $matching)
    {
        $input=[
           'confirmed'=>1,
        ];
        $matching->fill($input)->save();
        Matching::where([["reserve_id",'=', $matching->reserve_id],["confirmed",'=',0]])->delete();
        return redirect('/myreserve/' . $matching->reserve->id);
    }
    
    //予約を削除する
    public function delete_reserve(Reserve $reserve, Matching $matching)
    {
        $de_matching=$matching->where('reserve_id',$reserve->id)->first();
        $de_matching->delete();
        $reserve->delete();
        return redirect('/myreserve');
    }
    
    //マッチングを削除する
    public function delete_matching(Matching $matching)
    {
        $matching->delete();
        return redirect('/matchlist');
    }
    
    //過去のマッチング（送迎者側）へ移動
    public function past_use_pickup(Matching $matching)
    {
        return view('pastpickup')->with(['matchings' => $matching->getPaginateByLimitPastPickup(Auth::id())]);
    }
    
}
