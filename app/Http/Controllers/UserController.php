<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function top()
    {
        return view('top');
    }
    public function mypage()
    {
        return view('mypage');
    }
    public function myreserve()
    {
        return view('myreserve');
    }
    public function allreserve()
    {
        return view('allreserve');
    }
}
