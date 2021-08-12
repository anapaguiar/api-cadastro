<?php

namespace App;

use App\Usuario;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    public $timestamps = false; 
    protected $fillable = ['description', 'status', 'id_usuario'];

    public function tarefa(){

        return $this->belongsTo(Usuario::class);
    }
}