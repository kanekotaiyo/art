<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
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
    
    public function image_edit(User $user)
    {
        return view('imageedit')->with(['user' => $user]);
    }
    
    public function update(UserRequest $request, User $user)
    {
        //dd($request->file('image'));
        
        $input_user = $request['user'];
        
        //dd($data['car_image_path']);
        $user->fill($input_user)->save();
        return redirect('/mypage');
    }
    public function update_image(Request $request, User $user)
    {
        //dd($request->file('image'));
        //$input_user['name'] = $user->name;
        //$input_user['car'] = $user->car;
        //$input_user['comment'] = $user->comment;
        if($request->file('image')){
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
        //dd($path);
        // アップロードした画像のフルパスを取得
            $input_user['image_path'] = Storage::disk('s3')->url($path);
        }else{
            $input_user['image_path'] = null;
        }
        //dd($input_user);
        $user->fill($input_user)->save();
        return redirect('/mypage');
    }
    
    /*public function imagedelete(Request $request, User $user)
    {
        $input_user = $request['user'];
        $input_user['image_path'] = null;
        $user->fill($input_user)->save();
    }*/
    
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
