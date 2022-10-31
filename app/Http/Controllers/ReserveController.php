<?php

namespace App\Http\Controllers;

use App\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
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
  
    public function store(ReserveRequest $request, Reserve $reserve)
    {
        $input = $request['reserve'];
        $input['user_id'] = Auth::id();
        $input['allfinish'] = 0;
        $reserve->fill($input)->save();
        return redirect('/myreserve/' . $reserve->id);
    }
    
    public function allreserve(Reserve $reserve)
    {
        //dd($reserve->getPaginateByLimit2(Auth::id()));
        return view('allreserve')->with(['reserves' => $reserve->getPaginateByLimitAllreserve(Auth::id())]);
    }
    
    public function past_use(Reserve $reserve)
    {
        //dd($reserve->matchings()->get());
        $reserves=$reserve->getPaginateByLimitPastuse(Auth::id());
        $reserves->load('matchings');
        //dd($reserves);
        return view('pastuse')->with(['reserves' => $reserves]);
    }
    
    
}
