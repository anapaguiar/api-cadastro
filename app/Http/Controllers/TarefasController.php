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
            'Nao existem tarefas para este usuario.'], 
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

    public function update(int $id, Request $request)
    {
        $tarefa = Tarefa::find($id);
        if (is_null($tarefa))
        {
            return response()->json([
                'erro' => 'Tarefa nao encontrada.'], 
                status:404
            );
        }

        $tarefa->fill($request->only('description', 'status'));
        $tarefa->save();
    
        return $tarefa;
    }

    public function destroy (int $id)
    {
        $removidos = Tarefa::destroy($id);
        
        if ($removidos === 0) {
            return response()->json([
                'erro' => 'A tarefa nao foi encontrada.'
            ], 404);
        }

        return response()->json('Tarefa deletada', 204);
    }

}