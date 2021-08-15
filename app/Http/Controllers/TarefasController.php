<?php

namespace App\Http\Controllers;

use App\Tarefa;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TarefasController extends Controller 
{
    //tarefas por usuario
    public function index(int $id_usuario, Request $request){
       
        if ($id_usuario === Auth::user()->id)
        {
            return Tarefa::paginate($request->per_page);
        }

        return response()->json([
            'erro' => 'Recurso nao encontrado'], 
            status:404
        );
    }



    public function store (int $id, Request $request){

        if ($id === Auth::user()->id){
            return response()
            ->json(
                Tarefa::create($request->all()),
                status:201
            );
      }
      return response()->json('Usuario nao correspondente.', 404);

    }
}