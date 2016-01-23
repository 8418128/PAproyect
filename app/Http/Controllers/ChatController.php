<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chat;
use App\User;

class ChatController extends Controller
{
    public function getChatFromFriend(Request $request){
        $user = $request->session()->get('user_obj');
        $friend = User::find($request->input('friend'));
        //$friend = User::find(10);

        $chats = Chat::chatFrom($user,$friend);

        $person = ['me' => User::find($user->idUser), 'he' => $friend];

        //return json_encode($chats);
        return response()->json(['chats' => $chats, 'person' => $person]);

    }
}



