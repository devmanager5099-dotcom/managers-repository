<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoChat extends Model
{
     protected $fillable = ['msg', 'pedido_id', 'user_id'];

     public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
