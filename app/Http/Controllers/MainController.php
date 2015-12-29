<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Canvas;

class MainController extends Controller {

    public function myprofile(Request $request) {
        /*$user = $request->session()->get('user_obj');
        return view('main')->with('user',$user);*/

        $canvas = Canvas::where('id', 1)->first();;
        $user_o = $canvas->origen;
        $user_d = $canvas->destino;

        echo $user_o->nick;
        echo "</br>";
        echo $user_d->nick;



    }

}