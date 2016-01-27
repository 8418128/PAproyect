<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 09/01/2016
 * Time: 2:17
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    static public function viewCommentById($id){
        return Comment::where('painting','=',$id)->get();
    }
    public function publish(){
        //return User::where('idUser',$this->publish)->first();
        return User::find($this->publish);
   }

}