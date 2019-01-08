<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'conteudo_id', 'texto', 'data',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo');
    }

    //Acessors & mutators laravel
    public function getDataAttribute($value)
    {
        $data = date('H:i - d/m/Y', strtotime($value));
        return str_replace(':', 'h', $data);
        //return date('d/m/Y - H:i', strtotime($value));
    }
}
