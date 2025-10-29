<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comentarios extends Model
{
    protected $fillable = ['comentario', 'projeto_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
