<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function allpage(User $user)
    {
        return view('allpage')->with(['user' => $user]);
    }
}
