<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eixos extends Model
{
    use HasFactory;
    protected $fillable = ['nome_eixo', 'curso_id'];
    public function cursos(){
        return $this->belongsTo('App\Models\Cursos');
    }
    public function materias(){
        return $this->hasMany('App\Models\Materia');
    }
}
