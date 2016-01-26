<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 09/01/2016
 * Time: 2:26
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = array('canvas', 'user');

    public function getCanvas(){
        $this->hasOne(Canvas::class,'idCanvas','canvas');
    }
    static public function viewCanvasInvited($id){
        return Guest::where('user', $id)->get();
    }
}