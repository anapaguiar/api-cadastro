<?php

namespace App;

use App\Tarefa;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'cpf', 'password', 'status'];
    protected $perPage=5;

    public function tarefas ()
    {
        return $this->hasMany(Tarefa::class);
    }
    
}