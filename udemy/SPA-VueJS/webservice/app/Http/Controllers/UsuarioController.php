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
            //return $validacao->errors();
            return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();
            //$user->imagem = asset($user->imagem); //retorno a url da imagem com o dominio do servidor
            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, 'usuario' => $user];
        }

        return ['status' => false];
    }

    public function cadastrar(Request $request){

        $validacao = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validacao->fails()){
            //return $validacao->errors();
            return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
        }

        $imagem = '/imagens/default-profile.jpg';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'imagem' => $imagem
        ]);

        //criando e retornando token do usuario
        $user->token = $user->createToken($user->email)->accessToken;
        //$user->imagem = asset($user->imagem);

        return ['status' => true, 'usuario' => $user];
    }

    public function perfil(Request $request){
        $user = $request->user();

        if(isset($request->password)){
            $validacao = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
                'password' => 'required|string|min:6|confirmed',
            ]);

            if($validacao->fails()){
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
            }

            $user->password = bcrypt($request->password);
        }else{
            $validacao = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
            ]);

            if($validacao->fails()){
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if(isset($request->imagem)){

            //Validacao da imagem Base 64
            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg','jpeg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );
                // check file format
                if (!in_array($format, $allow)) {
                    return false;
                }
                // check base64 format
                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }
                return true;
            });

            $valiacao = Validator::make($request->all(), [
                'imagem' => 'base64image',

            ],['base64image'=>'Imagem inválida']);

            if($valiacao->fails()){
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
            }
            //

            $time = time();
            $diretorioPai = 'perfils';
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id_'.$user->id;
            $ext = substr($request->imagem, 11, strpos($request->imagem, ';') - 11);
            //return [$ext];

            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;

            $file = str_replace('data:image/'.$ext.';base64,', '', $request->imagem);
            //return [$file];

            //transformando o base64 em arquivo
            $file = base64_decode($file);

            if(!file_exists($diretorioPai)){
                mkdir($diretorioPai, 0700);
            }

            if($user->imagem){
                $imgUser = str_replace(asset('/'),'',$user->imagem);
                if(file_exists($imgUser)){
                    unlink($imgUser);
                }
            }

            if(!file_exists($diretorioImagem)){
                mkdir($diretorioImagem, 0700);
            }

            //persistindo 0 arquivo no servidor
            file_put_contents($urlImagem, $file);
            $user->imagem = $urlImagem;
        }

        $user->save();

        //$user->imagem = asset($user->imagem);//retorno a url da imagem com o dominio do servidor
        $user->token = $user->createToken($user->email)->accessToken;
        return ['status' => true, 'usuario' => $user];
    }

    /*public function usuario(Request $request){
        return $request->user();
    }*/

    public function amigo(Request $request)
    {
        $user = $request->user();
        $amigo = User::find($request->id);

        if($amigo && ($user->id != $amigo->id)) {
            $user->amigos()->toggle($amigo);
            return ['status' => true, 'amigos' => $user->amigos, 'seguidores' => $amigo->seguidores];
        }
        return ['status' => false, 'erro' => 'Usuário não encontrado'];
    }

    public function listaAmigos(Request $request)
    {
        $user = $request->user();
        if($user){
            return ['status' => true, 'amigos' => $user->amigos, 'seguidores' => $user->seguidores];
        }
        return ['status' => false, 'erro' => 'Usuário não encontrado'];
    }

    public function listaAmigosPagina($id, Request $request)
    {
        $user = User::find($id);
        $userLogado = $request->user();

        if($user){
            return ['status' => true, 'amigos' => $user->amigos, 'amigosLogado' => $userLogado->amigos, 'seguidores' => $user->seguidores];
        }
        return ['status' => false, 'erro' => 'Usuário não encontrado'];
    }
}
