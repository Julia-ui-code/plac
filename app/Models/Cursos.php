<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $fillable = ['curso', 'qnt_periodos', 'horas_materias', 'horas_estagio', 'horas_ativ'];
    public function user(){
        return $this->hasMany('App\Models\User');
    }
    public function eixos(){
        return $this->hasMany('App\Models\Eixos');
    }
}
