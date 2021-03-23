<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'periodo_id', 'fazer', 'concluido', 'estagio', 'ativs'];
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
    public function materias(){
        return $this->belongsTo('App\Models\Materia');
    }
}
