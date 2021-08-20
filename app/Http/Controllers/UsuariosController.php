<?php

namespace App\Http\Controllers;

use App\Tarefa;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;
use App\Http\Controllers\CriadorDeUsuario;

class UsuariosController extends Controller
{
    public function index (Request $request){

        return Usuario::paginate($request->per_page);
    
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

       return response()
        ->json(
            Usuario::create($data), 
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
    
    public function showStatusTarefa (int $id_usuario, int $status)
    {
        if (($id_usuario == Auth::user()->id))
        {
            $tarefa = Tarefa::query()
            ->where('id_usuario', $id_usuario)
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

        $tarefa = Tarefa::query()
            ->where('id_usuario', $id)
            ->get('status')->first();
        
        if (is_null($tarefa))
        {
            $removido->delete();
            return response()
                ->json('Usuario removido com sucesso.', 200);
        }
        
         return response()
            ->json('existem tarefas vinculadas ao usuario', 404);

    }
}
