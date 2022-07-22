<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provisionamentos extends Model
{
    public function professor(){
        return $this->belongsTo('App\User','professor_id','id');
    }
    public function responsavel(){
        return $this->belongsTo('App\User','user_id','id');
        
    }
    public function alunos(){
        return $this->hasMany('App\alunos_provisionamento','provisionamento_id','id');
    }
    public function aula(){
        return $this->belongsTo('App\aulas','aula_id','id');
    }
    
}
