<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alunos_provisionamento extends Model
{
    protected $table = 'alunos_provisionamento'; 


    public function aluno(){
        return $this->belongsTo('App\user','aluno_id','id');
    }


}