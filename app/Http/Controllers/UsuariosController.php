<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\CriadorDeUsuario;

class UsuariosController extends Controller
{
    public function index (Request $request){

        return Usuario::paginate($request->per_page);
    
    }

    public function store(Request $request, CriadorDeUsuario $criadorDeUsuario)
    {
       /* $usuario = $criadorDeUsuario->criarUsuario(
            $request->id, 
            $request->qtd_tarefas, 
            $request->status
        ); 
        return response()
            ->json(
                Usuario::create($usuario),
                status:201
            );*/
        
       return response()
        ->json(
            Usuario::create($request->all()), 
            status:201
        );
    }

    public function show(int $id){
        $usuario = Usuario::find($id);
        if(is_null($usuario)){
            return response()->json('Usuario nao encontrado.', status:404);
        }

        return response()->json($usuario);
    }
    

    public function update(int $id, Request $request)
    {
        $usuario = Usuario::find($id);
        if (is_null($usuario))
        {
            return response()->json([
                'erro' => 'Usuario nao encontrado'], 
                status:404
            );
        }

        $usuario->fill($request->all());
        $usuario->save();
    
        return $usuario;
    }

    public function destroy(int $id)
    {
        /*
        $user = Usuario::find($id);
        //quando eu descobrir como listar a qtd de tarefas, eu faco o destroy.
        $recursos = Usuario::where($user->tarefas > 1 );
        $recursos->tarefas->each(function (Tarefa $tarefa) { //vai pegar cada episodio
                $tarefa->delete();
        });

        $removido = Usuario::destroy($id);
        if (Tarefa::find($id)) {
            return response()->json([
                'erro' => 'Recurso nao encontrado'
            ], 404);
        }

        return response()->json('', 204); */
    }
}