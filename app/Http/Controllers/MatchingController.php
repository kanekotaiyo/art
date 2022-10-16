<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use App\Matching;
use App\Review;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    public function matching(Reserve $reserve, Matching $matching)
    {
        $user_id=Auth::id();
        $is_matching=$matching->where('reserve_id', $reserve->id)->where('user_id',$user_id)->first();
        //dd($is_matching);
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
    
    public function matchlist(Matching $matching)
    {
        /*$is_matching=$matching->where('confirmed', 1)->select('reserve_id')->get();
        //dd($is_matching);
        $is_matching_reserve=$matching->where('reserve_id',$is_matching)->get();
        dd($is_matching_reserve);
        if(isset($is_matching)){
            return redirect('/matchlist');
        }*/
        return view('matchlist')->with(['matchings' => $matching->getPaginateByLimitMatchlist(Auth::id())]);
    }
    
    public function show(Reserve $reserve, Matching $matching)
    {
        //$a=Matching::find(22);
        //dd(count($a->reviews()->get()));
        //dd($matching->get());
        $today = date("Y-m-d H:i:s");
        $reserve_id=$reserve->id;
        //dd($reserve_id);
        $user_id=Auth::id();
        if ($reserve->user_id==$user_id){
            return view('show')->with(['matchings' => $matching->getPaginateByLimitShow($reserve_id), 'reserve' => $reserve, 'today' => $today]);
        }else{
            return redirect('/myreserve');
        }
    }
    
    public function matching_confirm(Reserve $reserve, Matching $matching)
    {
        $input=[
           'confirmed'=>1,
        ];
        $matching->fill($input)->save();
        Matching::where([["reserve_id",'=', $matching->reserve_id],["confirmed",'=',0]])->delete();
        return redirect('/myreserve/' . $matching->reserve->id);
    }
    
    public function delete_reserve(Reserve $reserve, Matching $matching)
    {
        $de_matching=$matching->where('reserve_id',$reserve->id)->first();
        //dd($de_matching);
        $de_matching->delete();
        //dd($de_matching);
        $reserve->delete();
        return redirect('/myreserve');
    }
    
    public function delete_matching(Matching $matching)
    {
        $matching->delete();
        return redirect('/matchlist');
    }
    
    public function past_use_pickup(Matching $matching)
    {
        //dd($reserve->matchings()->get());
        //dd($reserves);
        return view('pastpickup')->with(['matchings' => $matching->getPaginateByLimitPastPickup(Auth::id())]);
    }
    
}
