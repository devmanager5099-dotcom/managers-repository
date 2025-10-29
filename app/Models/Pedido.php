<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/*
*   ******Estados*******
*   0 Esperando.
*   1 Aceite
*   2 Recusado
*   3 Cancelado pelo Usuário
*   4 Cancelado pelo ADMIN
*/

class Pedido extends Model
{
    protected $fillable = ['plataforma', 'nome', 'descricao', 'user_id', 'servico_id','estado', 'admin_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }
}
