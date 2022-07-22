<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agendamentos extends Model
{
    public function massagista(){
        return $this->belongsTo('App\massagistas','id_massagista','id');
    }
}
