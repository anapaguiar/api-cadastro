<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CriadorDeUsuario;
use App\Tarefa;

use function PHPUnit\Framework\isEmpty;

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
    
    public function showStatusTarefa (int $id, int $status)
    {
        if (($id === Auth::user()->id))
        {
            $tarefa = Tarefa::query()
            ->where('status', $status)
            ->get();

            return $tarefa;       
        }
        
        return response('Usuario nao correspondente.',404);
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
        $removido = Usuario::find($id);

        if (!empty($removido)){
            return response()
            ->json('existem tarefas vinculadas ao usuario', 404);
        }
            $removido->delete();
            return response()
                ->json('ok', 200);
    }
}