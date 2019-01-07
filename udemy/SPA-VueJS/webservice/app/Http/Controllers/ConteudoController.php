<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;

class ConteudoController extends Controller
{
    public function adicionar(Request $request)
    {
        $user = $request->user();

        //validacao aqui

        $conteudo = new Conteudo();
        $conteudo->titulo = $request->titulo;
        $conteudo->texto = $request->texto;
        $conteudo->imagem = $request->imagem ? $request->imagem : '#'; //como nao defini antes como nullable na migration faço o tratamento aqui
        $conteudo->link = $request->link ? $request->link : '#'; //como nao defini antes como nullable na migration faço o tratamento aqui
        $conteudo->data = date('Y-m-d H:i:s');

        $user->conteudos()->save($conteudo);

        //return ['status' => true, 'conteudos' => $user->conteudos];

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function listar(Request $request)
    {
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        return ['status' => true, 'conteudos' => $conteudos];
    }
}
