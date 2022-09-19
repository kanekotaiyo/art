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
            return redirect( '/matchlist' );
        }
        //return view('myreserve')->with(['reserves' => $reserve->getPaginateByLimit(Auth::id())]);
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
        return view('matchlist')->with(['matchings' => $matching->getPaginateByLimitMatchlist(Auth::id())]);
    }
    public function show(Reserve $reserve, Matching $matching)
    {
        //dd($reserve);
        $reserve_id=$reserve->id;
        //dd($reserve_id);
        return view('show')->with(['matchings' => $matching->getPaginateByLimitShow($reserve_id), 'reserve' => $reserve]);
    }
}
