<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Support\Facades\DB;

class CriadorDeUsuario {

    public function criarUsuario (
        int $id, 
        int $qtd_tarefas, 
        int $status)
    {

            $usuario = Usuario::create(['id' => $id]);
            $this->criarUsuario($qtd_tarefas, $status, $id);
            return $usuario->save();
    }
}