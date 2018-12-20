<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

Route::post('/cadastro', function (Request $request) {

    $validacao = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    //criando e retornando token do usuario
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::post('/login', function (Request $request) {

    $validacao = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    }

    return ['status' => false];
});

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/perfil', function (Request $request) {
    $user = $request->user();

    if(isset($request->password)){
        $validacao = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }

        $user->password = bcrypt($request->password);
    }else{
        $validacao = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }
    }

    $user->name = $request->name;
    $user->email = $request->email;

    if(isset($request->imagem)){
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

        if(!file_exists($diretorioImagem)){
            mkdir($diretorioImagem, 0700);
        }

        //persistindo 0 arquivo no servidor
        file_put_contents($urlImagem, $file);

        $user->imagem = $urlImagem;
    }

    $user->save();

    $user->imagem = asset($user->imagem);
    $user->token = $user->createToken($user->email)->accessToken;
    return $user;
});
