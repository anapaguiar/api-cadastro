<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller {
    
    public function gerarToken(Request $request)
    {
        //campos e regras de acesso
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'cpf' => 'required'
        ]);

        //pega o usuario do request
        $usuario = User::where(
            'email', $request->email)
            ->first();
        
        //confere o usuario e a senha
        if (is_null($usuario) 
            || !Hash::check($request->password, $usuario->password)
            ) {
                return response()->json('Usuario ou senha invalidos!', 401);
            }

        $token = JWT::encode(
            ['email'=> $request->email], 
            env('JWT_KEY'));
        
        return [
            'access_token' => $token
        ];
    }
}