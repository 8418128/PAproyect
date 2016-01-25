<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
//table USERS
class User extends Model
{
	protected $primaryKey = 'idUser';

	static public function findByUserPass($email,$password){ //OBTENER EL USUARIO MEDIANTE MAIL Y PASS
		$u = User::where('email','like', $email)->first();
		if(!is_null($u)&&Hash::check($password, $u->password)) {
			return $u;
		}
		return null;

	}

	static public function findByUserEmail($email){ //OBTENER USUARIO MEDIANTE EMAIL
		$u = User::where('email','like', $email)->first();
		if(!is_null($u)) {
			return $u;
		}
		return null;
	}


	static public function findByUserName($name){ //OBTENER USUARIO MEDIANTE NAme
		//DB::enableQueryLog();
		$u = User::where('name','like', '%'.$name.'%')->get();
		//dd(DB::getQueryLog());
		if(!is_null($u)) {
			return $u;
		}
		return null;
	}


	static public function alreadyIn($user){
		if(!is_null(User::where('email','like', $user)->first())){
			return true;
		}
		return false;
	}

	static public function getUserById($id){
		$user=User::where('idUser','=',$id)->get();
		return $user;
	}

	public function gallery(){
		return $this->hasMany('App\Painting');
	}
	public function atelier(){
		return $this->hasMany('App\Canvas');
	}
	public function friends(){
		return $this->hasMany('App\Friend');
	}
	public function likesPaintings(){
		return $this->hasMany('App\Like_painting');
	}

	/*public function imagesLike($c)
	{
		return $this->hasMany('App\Image')->where('comment','LIKE','%'.$c.'%')->get();
	}*/
}
