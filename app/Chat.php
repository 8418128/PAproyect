<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Chat extends Model
{
    protected $primaryKey = 'idChat';

    public function origen()
    {
        return $this->belongsTo(User::class, 'sends');
    }
    public function destino()
    {
        return $this->belongsTo(User::class, 'receives');
    }

    public static function chatFrom($me,$friend){
        return Chat::where(function($query)use ($me,$friend) {
            $query->where('sends', $me->idUser)
                ->where('receives', $friend->idUser);
        })->orWhere(function($query)use ($me,$friend){
            $query->where('receives', $me->idUser)
                ->where('sends', $friend->idUser);
        })->get();
    }

}