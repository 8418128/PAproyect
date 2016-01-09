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
}
