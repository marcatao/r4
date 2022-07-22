<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function login(){
        return $this->hasMany('App\massagistas','massagista_id','id');
    }
    public function massagista(){
        return $this->belongsTo('App\massagistas','massagista_id','id');
    }
    public function getVlTotAttribute(){
        return $this->qtd * $this->vl_movimento ;
    }
}
