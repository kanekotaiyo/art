<?php

namespace App\Http\Controllers;

use App\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function myreserve(Reserve $reserve)
    {
        return view('myreserve')->with(['reserves' => $reserve->getPaginateByLimit(Auth::id())]);
    }
    public function show(Reserve $reserve)
    {
        //dd($reserve);
        return view('show')->with(['reserve' => $reserve]);
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
}
