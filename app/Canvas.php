<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canvas extends Model
{
    protected $table = 'canvas';

    public function origen()
    {
        return $this->belongsTo(User::class, 'id_origen');
    }
    public function destino()
    {
        return $this->belongsTo(User::class, 'id_destino');
    }
    /**
     * @inheritdoc
     */
    protected function serializeDate(\DateTime $date)
    {
        return $date->getTimestamp();
    }
}
