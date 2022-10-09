<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Matching;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Matching $matching)
    {
        return view('review')->with(['matching' => $matching]);
    }
    
    public function reviewing(Request $request, Matching $matching, Review $review)
    {
        //dd($matching)->get();
        $input = $request['review'];
        $input['reviewing_id'] = Auth::id();
        $input['reviewed_id'] = $matching->user_id;
        $input['matching_id'] = $matching->id;
        //dd($review)->get();
        $review->fill($input)->save();
        return redirect('/myreserve');
    }
}
