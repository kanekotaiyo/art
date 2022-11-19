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
    
    //topページへの移動
    public function top()
    {
        return view('top');
    }
    
    //ログイン中のマイページへ移動
    public function mypage(User $user)
    {
        $user_id = Auth::id();
        $user_info = $user->where("id", $user_id)->first();
        $review=Review::where("reviewed_id",$user_id);
        $count=count($review->get());
        $average=$review->avg('review');
        return view('mypage')->with(['user' => $user_info, 'reviews'=>$review, 'count'=>$count, 'avg'=>round($average, 1)]);
    }
    
    //プロフィール編集画面へ移動
    public function edit(User $user)
    {
        return view('edit')->with(['user' => $user]);
    }
    
    //プロフィール写真変更へ移動
    public function image_edit(User $user)
    {
        return view('imageedit')->with(['user' => $user]);
    }
    
    //プロフィールの変更をしてマイページへ
    public function update(UserRequest $request, User $user)
    {
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        return redirect('/mypage');
    }
    
    //プロフィール写真を変更してマイページへ
    public function update_image(Request $request, User $user)
    {
        if($request->file('image')){
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
            $input_user['image_path'] = Storage::disk('s3')->url($path);
        }else{
            $input_user['image_path'] = null;
        }
        $user->fill($input_user)->save();
        return redirect('/mypage');
    }
    
    //他の人のプロフィール画面に移動
    public function allpage(User $user)
    {
        $review=Review::where("Reviewed_id",$user->id);
        $count=count($review->get());
        $average=$review->avg('review');
        return view('allpage')->with(['user' => $user, 'reviews'=>$review, 'count'=>$count, 'avg'=>round($average, 1)]);
    }
    
    //レビューコメント一覧に移動
    public function reviewcomment(User $user, Review $review)
    {
        return view('reviewcomment')->with(['reviews' => $review->getPaginateByLimit($user->id)]);
    }
}
