<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Review;
use App\Matching;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //レビュー画面に移動
    public function review(Matching $matching)
    {
        return view('review')->with(['matching' => $matching]);
    }
    
    //レビューを保存しreviewテーブルに格納しマッチングを終了する
    public function reviewing(Request $request, ReviewRequest $reviewrequest, Matching $matching, Review $review)
    {
        $input = $reviewrequest['review'];
        $input['reviewing_id'] = Auth::id();
        $input['reviewed_id'] = $matching->user_id;
        $input['matching_id'] = $matching->id;
        $review->fill($input)->save();
        $input_reserve = $request['reserve'];
        $input_reserve['allfinish']=1;
        $matching->reserve->fill($input_reserve)->save();
        return redirect('/myreserve');
    }
}
