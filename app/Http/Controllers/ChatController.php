<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chat;
use App\User;

class ChatController extends Controller implements Pusheable
{
    public function getChatFromFriend(Request $request){
        $user = $request->session()->get('user_obj');
        $friend = User::find($request->input('friend'));
        //$friend = User::find(10);


        $chats = Chat::chatFrom($user,$friend);

        $person = ['me' => User::find($user->idUser), 'he' => $friend];

        return response()->json(['chats' => $chats, 'person' => $person]);

    }

    function push(Request $request)
    {

        $json = $request->input('chat');
        $newChat = new Chat();
        $newChat->sends=$json['sends'];
        $newChat->receives=$json['receives'];
        $newChat->text=$json['text'];
        $newChat->save();
        event(new \App\Events\ChEvent($json['receives'],$json));
        return "OKK-->";
    }
}



