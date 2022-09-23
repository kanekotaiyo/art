<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use App\Matching;
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
        }
        $input=[
            'reserve_id'=>$reserve->id,
            'user_id'=>Auth::id(),
            'confirmed'=>0,
        ];
        $matching->fill($input)->save();
        return redirect('/matchlist');
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
        //dd($matching->get());
        $reserve_id=$reserve->id;
        //dd($reserve_id);
        //$user_id=Auth::id();
        
        return view('show')->with(['matchings' => $matching->getPaginateByLimitShow($reserve_id), 'reserve' => $reserve]);
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
    
}
