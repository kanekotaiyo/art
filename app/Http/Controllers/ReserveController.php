<?php

namespace App\Http\Controllers;

use App\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function myreserve(Reserve $reserve)
    {
        return view('myreserve')->with(['reserves' => $reserve->getPaginateByLimitMyreserve(Auth::id())]);
    }
    
    public function create()
    {
        return view('create');
    }
  
    public function store(Request $request, Reserve $reserve)
    {
        $input = $request['reserve'];
        $input['user_id'] = Auth::id();
        $reserve->fill($input)->save();
        return redirect('/myreserve/' . $reserve->id);
    }
    
    public function allreserve(Reserve $reserve)
    {
        //dd($reserve->getPaginateByLimit2(Auth::id()));
        return view('allreserve')->with(['reserves' => $reserve->getPaginateByLimitAllreserve(Auth::id())]);
    }
}
