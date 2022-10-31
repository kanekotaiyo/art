<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use App\Chat;
use App\Matching;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function reservechat(Matching $matching, Chat $chat)
    {
        $matching_id=$matching->id;
        //dd($matching);
        //dd($reserve_id);
        $user_id=Auth::id();
        if ($matching->reserve->user_id==$user_id){
            return view('reservechat')->with(['matching' => $matching, 'chats' => $chat->getPaginateByLimitChat($matching_id)]);
        }else{
            return redirect('/myreserve');
        }
    }
    public function reservemessage(Request $request, Chat $chat, Matching $matching)
    {
        $input = $request['chat'];
        $input['from_id'] = Auth::id();
        $input['to_id'] = $matching->user_id;
        $input['matching_id'] = $matching->id;
        $chat->fill($input)->save();
        return redirect('/reservechat/' . $matching->id);
    }
    
    public function pickupchat(Matching $matching, Chat $chat)
    {
        $matching_id=$matching->id;
        //dd($matching);
        //dd($reserve_id);
        $user_id=Auth::id();
        if ($matching->user_id==$user_id){
            return view('pickupchat')->with(['matching' => $matching, 'chats' => $chat->getPaginateByLimitChat($matching_id)]);
        }else{
            return redirect('/matchlist');
        }
    }
    public function pickupmessage(ChatRequest $request, Chat $chat, Matching $matching)
    {
        $input = $request['chat'];
        $input['from_id'] = Auth::id();
        $input['to_id'] = $matching->reserve->user_id;
        $input['matching_id'] = $matching->id;
        $chat->fill($input)->save();
        return redirect('/pickupchat/' . $matching->id);
    }
}
