<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;
use Illuminate\Support\Facades\Validator;
use App\User;

class ConteudoController extends Controller
{
    public function adicionar(Request $request)
    {
        $user = $request->user();

        //validacao
        $validacao = Validator::make($request->all(), [
            'titulo' => 'required',
            'texto' => 'required'
        ]);

        if($validacao->fails()){
            return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
        }

        $conteudo = new Conteudo();
        $conteudo->titulo = $request->titulo;
        $conteudo->texto = $request->texto;
        $conteudo->imagem = $request->imagem ? $request->imagem : '#'; //como nao defini antes como nullable na migration faço o tratamento aqui
        $conteudo->link = $request->link ? $request->link : '#'; //como nao defini antes como nullable na migration faço o tratamento aqui
        $conteudo->data = date('Y-m-d H:i:s');

        $user->conteudos()->save($conteudo);

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function listar(Request $request)
    {
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);

        $user = $request->user();
        foreach ($conteudos as $key => $conteudo) {
            $conteudo->total_curtidas = $conteudo->curtidas()->count();
            $conteudo->comentarios = $conteudo->comentarios()->with('user')->orderBy('data', 'DESC')->get();
            $curtiu = $user->curtidas()->find($conteudo->id);
            if($curtiu){
                $conteudo->curtiu_conteudo = true;
            }else{
                $conteudo->curtiu_conteudo = false;
            }
        }

        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function curtir($id, Request $request)
    {
        $conteudo = Conteudo::find($id);

        if($conteudo){
            $user = $request->user();
            $user->curtidas()->toggle($conteudo->id);
            return [
                'status' => true,
                'curtidas' => $conteudo->curtidas()->count(),
                'lista' => $this->listar($request)
            ];
        }

        return ['status' => false, 'erro' => 'Conteúdo não existe'];
    }

    public function comentar($id, Request $request)
    {
        $conteudo = Conteudo::find($id);

        if($conteudo){
            $user = $request->user();
            $user->comentarios()->create([
                'conteudo_id' => $conteudo->id,
                'texto' => $request->texto,
                'data' => date('Y-m-d H:i:s')
                ]);

            return [
                'status' => true,
                'lista' => $this->listar($request)
            ];
        }

        return ['status' => false, 'erro' => 'Conteúdo não existe'];
    }

    public function pagina($id, Request $request)
    {
        $donoPagina = User::find($id);
        if($donoPagina){

            $conteudos = $donoPagina->conteudos()->with('user')->orderBy('data', 'DESC')->paginate(5);
            $user = $request->user();

            foreach ($conteudos as $key => $conteudo) {
                $conteudo->total_curtidas = $conteudo->curtidas()->count();
                $conteudo->comentarios = $conteudo->comentarios()->with('user')->orderBy('data', 'DESC')->get();
                $curtiu = $user->curtidas()->find($conteudo->id);
                if($curtiu){
                    $conteudo->curtiu_conteudo = true;
                }else{
                    $conteudo->curtiu_conteudo = false;
                }
            }
            return ['status' => true, 'conteudos' => $conteudos, 'dono' => $donoPagina];
        }

        return ['status' => false, 'erro' => 'Usuário não existe!'];
    }
}
