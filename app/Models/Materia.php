<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['curso_id', 'eixo_id','nome_materia','pre_req', 'co_req', 'horas','cat', 'indice'];
    public function cursos(){
        return $this->belongsTo('App\Models\Cursos');
    }
    public function eixos(){
        return $this->belongsTo('App\Models\Eixos');
    }
    public function materia_users(){
        return $this->hasMany('App\Models\MateriaUser');
    }
}
