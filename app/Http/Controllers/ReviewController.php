<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Review;
use App\Matching;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Matching $matching)
    {
        return view('review')->with(['matching' => $matching]);
    }
    
    public function reviewing(Request $request, ReviewRequest $reviewrequest, Matching $matching, Review $review)
    {
        //dd($matching)->get();
        $input = $reviewrequest['review'];
        //dd($input);
        $input['reviewing_id'] = Auth::id();
        $input['reviewed_id'] = $matching->user_id;
        $input['matching_id'] = $matching->id;
        //dd($review)->get();
        $review->fill($input)->save();
        
        $input_reserve = $request['reserve'];
        $input_reserve['allfinish']=1;
        $matching->reserve->fill($input_reserve)->save();
        return redirect('/myreserve');
    }
}
