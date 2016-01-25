<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Input;
use File;
class UsersController extends Controller {

  public function login(Request $request) { //VALIDAR EL LOGIN

      $email = $request->input("email");
      $password = $request->input("password");

    $user_obj = User::findByUserPass($email,$password);
    if ( !is_null($user_obj) ) {
        $user_obj->connected=1;
        $user_obj->save();
        $request->session()->put('user_obj', $user_obj);
        $prev_path = $request->cookie('prev_path');
        if(!is_null($prev_path)){
            return redirect($prev_path);
        }
        return redirect('home');

      } 
      else {
        return back()
          ->withInput($request->only("email"))
          ->withErrors(['auth' => 'El usuario o contraseña son incorrectos.']);
      }

    }

    public function getMyProfile(Request $request){
        $user=$request->session()->get('user_obj');
       $photo=$user->photo;
        if($photo=="") {
            $photo = "noimg.png";
        }
        return view('profile', ['name' => $user->name,
            'surname'=>$user->surname,
            'photo'=>$photo,
            'birthdate'=>$user->birthDate,
            'email'=>$user->email]);

    }

    public function getProfile2(Request $request){
        $user=$request->session()->get('user_obj');
        $photo=$user->photo;
        if($photo==""){
            $photo="noimg.png";
        }
        return view('editProfile', ['name' => $user->name,
            'surname'=>$user->surname,
            'photo'=>$photo,
            'birthdate'=>$user->birthDate,
            'email'=>$user->email]);

    }

    public function getProfile3($id){
        $user=User::getUserById($id);
        //echo $user->get(0)->name;
        if($user->get(0)->photo==""){
            $photo="noimg.png";
        }else{
            $photo=$user->get(0)->photo;
        }
       return view('friendProfile', ['name' => $user->get(0)->name,
            'surname'=>$user->get(0)->surname,
            'photo'=>$photo,
            'birthdate'=>$user->get(0)->birthDate,
            'email'=>$user->get(0)->email]);

    }


    public function register(Request $request)//REGISTRAR
    {
        $rules = array(
            'name' => 'required',
            'surname' => 'required',
            'birthDate' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'email' => 'required|email|unique:users',

        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $name = $request->input("name");
        $surname = $request->input("surname");

        $birthdate = $request->input("birthDate");
        if(!preg_match('/^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/',$birthdate)){
            return back()
                    ->withErrors('La fecha no es valida '.$birthdate.' (dd-mm-aaaa)')
                    ->withInput();
        }

        $email = $request->input("email");
        $photo = $request->file("photo");
        $password = $request->input("password");
        $new_user = new User;

        $new_user->password=Hash::make($password);
        $new_user->email=$email;
        $new_user->name=$name;
        $new_user->surname=$surname;
        $new_user->birthDate=$birthdate;

        if(!is_null($photo)){
           $photo=$this->savePhoto($request);
            $new_user->photo=$photo;
        }

        $new_user->save();

        $request->session()->put('user_obj', $new_user);
       return redirect('home');

    }

    function savePhoto(Request $request){//Guardar la foto en el directorio image

        $imageName = uniqid().".".$request->file('photo')->getClientOriginalExtension();
        echo $imageName;
        $request->file('photo')->move(public_path("generalImg")."\\",$imageName);

        return $imageName;
    }

    public function getChat(Request $request){ //OBTENER EL CHAT DEL USUARIO HAY K RETOCARLO
        $chats = \App\Chat::getChats(1,2);
        foreach($chats as $chat) {
            echo $chat->origen->email . " " . $chat->text;
        }
    }

    public function update(Request $request){//Update perfil usuario

        $user_old = $request->session()->get('user_obj');



        $rules = array(
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email',

        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $email= User::where('email','<>',$user_old->email)->where('email','like', $request->input('email'))->get();
        if(count($email)!= 0){
            return back()
                ->withErrors('El email ya esta registrado')
                ->withInput();
        }


        $birthdate = $request->input("birthdate");
       if(!preg_match('/^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/',$birthdate)){
            return back()
                ->withErrors('La fecha no es valida '.$birthdate.' (dd-mm-aaaa)')
                ->withInput();
        }
        $photo = $request->file("photo");

        if(!is_null($photo)){

            $f=public_path("generalImg")."\\".$user_old->photo;
            File::delete($f);
            $photo=$this->savePhoto($request);
            $user_old->photo=$photo;

        }
        $user_old->name=$request->input("name");
        $user_old->surname=$request->input("surname");
        $user_old->birthDate=$request->input("birthdate");
        $user_old->email=$request->input("email");

        $user_old->save();
        //Session::forget('user_obj');
        $request->session()->put('user_obj', $user_old);
        return redirect('myProfile');

    }
      
}
