<?php

namespace App\Http\Controllers;

use App\User;
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
        $user_info = $user->where("id", "$user_id")->first();
        //dd($user_info);
        return view('mypage')->with(['user' => $user_info]);
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
        return view('allpage')->with(['user' => $user]);
    }
}
