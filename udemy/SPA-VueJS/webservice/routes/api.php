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
Route::middleware('auth:api')->post('/usuario/amigo', 'UsuarioController@amigo');
Route::middleware('auth:api')->get('/usuario/lista/amigos', 'UsuarioController@listaAmigos');
Route::middleware('auth:api')->get('/usuario/lista/amigos/pagina/{id}', 'UsuarioController@listaAmigosPagina');

Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/listar', 'ConteudoController@listar');
Route::middleware('auth:api')->get('/conteudo/pagina/listar/{id}', 'ConteudoController@pagina');

//Para utilizar em Home
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', 'ConteudoController@curtir');
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', 'ConteudoController@comentar');
//Para utilizar em Pagina
Route::middleware('auth:api')->put('/conteudo/pagina/curtir/{id}', 'ConteudoController@curtirPagina');
Route::middleware('auth:api')->put('/conteudo/pagina/comentar/{id}', 'ConteudoController@comentarPagina');

Route::get('/testes', function(){

    $user = User::find(1);
    $amigos = $user->amigos()->pluck('id');
    $amigos->push($user->id);

    $conteudos = Conteudo::whereIn('user_id', $amigos)->with('user')->orderBy('data', 'DESC')->paginate(5);

    dd($conteudos);

    //$user = User::find(2);
    //$user2 = User::find(7);

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
    /*$conteudo = Conteudo::find(14);
    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Show de bola!',
        'data' => date('Y-m-d H:i:s')
        ]);

    $user2->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Não gostei!',
        'data' => date('Y-m-d H:i:s')
        ]);
    return $conteudo->comentarios;*/
});
