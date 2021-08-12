<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index (Request $request){

        return Usuario::paginate($request->per_page);
    
    }

    public function store(Request $request){

        return response()
        ->json(
            Usuario::create($request->all()), 
            status:201
        );
    }
}