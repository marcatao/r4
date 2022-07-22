<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operacoes extends Model
{
    public function armario(){
        return $this->belongsTo('App\armarios','id_armario','id');
    }

    public function itens(){
        return $this->belongsTo('App\item','id','id_operacao');
    }
    public function produtos(){
        return $this->belongsTo('App\item','id','id_operacao')->where('produto_id','<>','null');
    }
    public function massagistas(){
        return $this->hasMany('App\item','id_operacao','id')->whereNotNull('massagista_id');
    }
}
