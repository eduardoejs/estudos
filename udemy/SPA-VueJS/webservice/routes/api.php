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

//Route::middleware('auth:api')->get('/usuario', 'UsuarioController@usuario');
Route::middleware('auth:api')->put('/perfil', 'UsuarioController@perfil');

Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/listar', 'ConteudoController@listar');
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', 'ConteudoController@curtir');

Route::get('/testes', function(){
    //$user = User::find(1);
    //$user2 = User::find(2);

    /*$conteudos = Conteudo::all();
    foreach ($conteudos as $key => $value) {
        $value->delete();
    } */

    /*$user->conteudos()->create([
        'titulo' => 'Conteudo Titulo 3',
        'texto' => 'Aqui é o conteudo do Titulo 3',
        'imagem' => 'url-image',
        'link' => 'http://abc.com',
        'data' => '2018-12-28'
        ]);
    return $user->conteudos;*/

    //add amigos
    //$user->amigos()->attach($user2);
    //$user->amigos()->detach($user2);
    //$user->amigos()->toggle($user2);
    //return $user->amigos;

    //add curtidas
    //$conteudo = Conteudo::find(1);
    //$user->curtidas()->toggle($conteudo->id);
    //return $conteudo->curtidas()->count();//retorna um valor numerico
    //return $conteudo->curtidas;

    //add comentarios
    /*$conteudo = Conteudo::find(1);
    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Show de bola!',
        'data' => date('Y-m-d')
        ]);

    $user2->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Não gostei!',
        'data' => date('Y-m-d')
        ]);
    return $conteudo->comentarios;*/

});
