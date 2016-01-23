<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 09/01/2016
 * Time: 2:26
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'friend');
    }

    public function us(){
        return $this->hasOne(User::class,'idUser','friend');
    }

    static public function getPeticionFriend($user){
        return Friend::where('status','=','0')->where('user','=',$user)->where('action_user','=','0')->get();
    }

    static public function getFriendsDelete($idUser,$idFriend){
        $friends=Friend::where('user','=',$idUser)->where('friend','=',$idFriend)->delete();

}
    static public function getFriends($idUser,$idFriend){
        return Friend::where('user','=',$idUser)->where('friend','=',$idFriend)->get();
    }

    static public function updateFriend($friend){

        Friend::where('user','=',$friend->user)->where('friend','=',$friend->friend)->update(['status'=>1]);

    }

}
