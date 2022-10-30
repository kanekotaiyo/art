<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;


class UserController extends Controller
{
    public function top()
    {
        return view('top');
    }
    
    public function mypage(User $user)
    {
        $user_id = Auth::id();
        $user_info = $user->where("id", $user_id)->first();
        $review=Review::where("reviewed_id",$user_id);
        $count=count($review->get());
        $average=$review->avg('review');
        //dd(round($review, 1));
        //dd($user_info);
        return view('mypage')->with(['user' => $user_info, 'reviews'=>$review, 'count'=>$count, 'avg'=>round($average, 1)]);
    }
    
    public function edit(User $user)
    {
        return view('edit')->with(['user' => $user]);
    }
    
    public function update(Request $request, User $user)
    {
        //dd($request->file('image'));
        $car_image = $request->file('car_image');
        
        $input_user = $request['user'];
        if(isset($car_image)){
            $path = Storage::disk('s3')->putFile('myprefix', $car_image, 'public');
        
        //dd($path);
        // アップロードした画像のフルパスを取得
            $input_user['car_image_path'] = Storage::disk('s3')->url($path);
        }else{
            $input_user['car_image_path'] = null;
        }
        //dd($data['car_image_path']);
        $user->fill($input_user)->save();
        return redirect('/mypage');
    }
    
    public function allpage(User $user)
    {
        $review=Review::where("Reviewed_id",$user->id);
        $count=count($review->get());
        $average=$review->avg('review');
        return view('allpage')->with(['user' => $user, 'reviews'=>$review, 'count'=>$count, 'avg'=>round($average, 1)]);
    }
    
    public function reviewcomment(User $user, Review $review)
    {
        return view('reviewcomment')->with(['reviews' => $review->getPaginateByLimit($user->id)]);
    }
}
