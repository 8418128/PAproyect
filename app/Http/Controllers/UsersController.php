<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Input;
class UsersController extends Controller {

  public function login(Request $request) {

    $user = $request->input("user");
    $pass = $request->input("pass");

    $user_obj = User::findByUserPass($user,$pass);

    if ( !is_null($user_obj) ) {
        $request->session()->put('user_obj', $user_obj);
        return redirect('/main');

      } 
      else {
        return back()
          ->withInput($request->only("user"))
          ->withErrors(['auth' => 'El usuario o contraseña son incorrectos.']);
      }

    }
    public function register(Request $request)
    {
        /*$user = $request->input("user");
        $pass = $request->input("pass");

        if (!(User::alreadyIn($user))) {
            $email = $request->input("email");

            $new_user = new User;

            $new_user->nick=$user;

            $new_user->password=Hash::make($pass);
            $new_user->email=$email;

            $new_user->save();

            $request->session()->put('user_obj', $new_user);
            return redirect('/main');
        }
        else{
            return redirect('regForm')
                ->withInput($request->except('pass'))
                ->withErrors(['exist' => 'El usuario ya existe.']);
        }*/

        $rules = array(
            'nick' => 'required|unique:users|max:5',
            'pass' => 'required',
            'email' => 'required|email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $nick = $request->input("nick");
        $pass = $request->input("pass");
        $email = $request->input("email");

        $new_user = new User;

        $new_user->nick=$nick;
        $new_user->password=Hash::make($pass);
        $new_user->email=$email;

        $new_user->save();

        $request->session()->put('user_obj', $new_user);
        return redirect('/main');

    }
      
}
