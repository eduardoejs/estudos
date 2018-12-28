<?php

use App\User;
use App\Conteudo;
use App\Comentario;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/cadastro', 'UsuarioController@cadastrar');
Route::post('/login', "UsuarioController@login");

Route::middleware('auth:api')->get('/usuario', 'UsuarioController@usuario');
Route::middleware('auth:api')->put('/perfil', 'UsuarioController@perfil');


Route::get('/testes', function(){
    $user = User::find(1);
    
    /*$user->conteudos()->create([
        'titulo' => 'Conteudo Titulo 3',
        'texto' => 'Aqui é o conteudo do Titulo 3',
        'imagem' => 'url-image',
        'link' => 'http://abc.com',
        'data' => '2018-12-28'
        ]);*/
    return $user->conteudos;
});