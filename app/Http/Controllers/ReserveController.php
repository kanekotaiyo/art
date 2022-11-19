<?php

namespace App\Http\Controllers;

use App\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    //予約状況画面へ移動
    public function myreserve(Reserve $reserve)
    {
        return view('myreserve')->with(['reserves' => $reserve->getPaginateByLimitMyreserve(Auth::id())]);
    }
    
    //新しい予約画面へ移動
    public function create()
    {
        return view('create');
    }
    
    //新しい予約を保存しreserveテーブルに格納
    public function store(ReserveRequest $request, Reserve $reserve)
    {
        $input = $request['reserve'];
        $input['user_id'] = Auth::id();
        $input['allfinish'] = 0;
        $reserve->fill($input)->save();
        return redirect('/myreserve/' . $reserve->id);
    }
    
    //みんなの予約画面へ移動
    public function allreserve(Reserve $reserve)
    {
        return view('allreserve')->with(['reserves' => $reserve->getPaginateByLimitAllreserve(Auth::id())]);
    }
    
    //過去のマッチング（予約者側）へ移動
    public function past_use(Reserve $reserve)
    {
        $reserves=$reserve->getPaginateByLimitPastuse(Auth::id());
        $reserves->load('matchings');
        return view('pastuse')->with(['reserves' => $reserves]);
    }
    
    
}
