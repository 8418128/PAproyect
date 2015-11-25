<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MainController extends Controller {

    public function myprofile(Request $request) {

        $user = $request->session()->get('user_obj');
        return view('main')->with('user',$user);
    }

}