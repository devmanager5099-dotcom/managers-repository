<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = ['linguagem', 'nome', 'descricao', 'versao', 'zip'];
}
