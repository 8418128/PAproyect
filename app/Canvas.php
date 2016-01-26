<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canvas extends Model
{
    protected $table = 'canvas';
    protected $primaryKey = 'idCanvas';
    protected $fillable = array('editable', 'title', 'user');

    /*public function origen()
    {
        return $this->belongsTo(User::class, 'id_origen');
    }
    public function destino()
    {
        return $this->belongsTo(User::class, 'id_destino');
    }*/
    /**
     * @inheritdoc
     */
    protected function serializeDate(\DateTime $date)
    {
        return $date->getTimestamp();
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function guests(){
        return $this->hasMany('App\Guest');
    }
    static public function viewCanvas($id){
        return Canvas::where('user','=',$id)->get();
    }

    static public function getCanvasId($ids){
        return Canvas::whereIn('idCanvas',$ids)->get();

    }

}
