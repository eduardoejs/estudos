<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    protected $fillable = [
        'titulo', 'texto', 'imagem', 'link', 'data',
    ];

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function curtidas()
    {
        //passagem de parametros na definicao do relacionamento, observar que não foi seguido o padrão
        //do Laravel. Ver documentacao: (modelo a ser relacionado, nome da tabela, foreign modelo, foreign modelo a ser relacionado)
        return $this->belongsToMany('App\User', 'curtidas', 'conteudo_id','user_id');
    }

    //Acessors & mutators laravel
    public function getDataAttribute($value)
    {
        $data = date('H:i - d/m/Y', strtotime($value));
        return str_replace(':', 'h', $data);
        //return date('d/m/Y - H:i', strtotime($value));
    }
}
