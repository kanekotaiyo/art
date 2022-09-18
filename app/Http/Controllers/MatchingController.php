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
        //return view('myreserve')->with(['reserves' => $reserve->getPaginateByLimit(Auth::id())]);
        $input=[
            'reserve_id'=>$reserve->id,
            'user_id'=>Auth::id(),
            'confirmed'=>0,
        ];
        $matching->fill($input)->save();
        return redirect('/allreserve');
    }
     public function matchlist(Matching $matching)
    {
        return view('matchlist')->with(['matchings' => $matching->getPaginateByLimit(Auth::id())]);
    }
}
