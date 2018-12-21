<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function login(Request $request) {

        $validacao = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();
            $user->imagem = asset($user->imagem); //retorno a url da imagem com o dominio do servidor
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;
        }

        return ['status' => false];
    }
}
