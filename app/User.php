<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class User extends Model
{

	static public function findByUserPass($user,$pass){
		$u = User::where('nick', $user)->first();
		if(!is_null($u)&&Hash::check($pass, $u->password)) {
			return $u;
		}
		return null;
	}

	static public function alreadyIn($user){
		if(!is_null(User::where('nick', $user)->first())){
			return true;
		}
		return false;

	}

    public function images()
    {
        return $this->hasMany('App\Image');
    }

	public function imagesLike($c)
	{
		return $this->hasMany('App\Image')->where('comment','LIKE','%'.$c.'%')->get();
	}
}
