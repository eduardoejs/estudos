<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'imagem',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function conteudos()
    {
        return $this->hasMany('App\Conteudo');
    }

    public function curtidas()
    {
        //passagem de parametros na definicao do relacionamento, observar que não foi seguido o padrão
        //do Laravel. Ver documentacao: (modelo a ser relacionado, nome da tabela, foreign modelo, foreign modelo a ser relacionado)
        return $this->belongsToMany('App\Conteudo', 'curtidas', 'user_id', 'conteudo_id');
    }

    public function amigos()
    {
        //passagem de parametros na definicao do relacionamento, observar que não foi seguido o padrão
        //do Laravel. Ver documentacao: (modelo a ser relacionado, nome da tabela, foreign modelo, foreign modelo a ser relacionado)
        return $this->belongsToMany('App\User', 'amigos', 'user_id', 'amigo_id');
    }

    public function seguidores()
    {
        //passagem de parametros na definicao do relacionamento, observar que não foi seguido o padrão
        //do Laravel. Ver documentacao: (modelo a ser relacionado, nome da tabela, foreign modelo, foreign modelo a ser relacionado)
        return $this->belongsToMany('App\User', 'amigos', 'amigo_id', 'user_id');
    }

    //Acessors & mutators laravel
    public function getImagemAttribute($value)
    {
        return asset($value);
    }
}
