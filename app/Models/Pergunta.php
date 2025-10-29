<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pergunta extends Model
{
    protected $fillable = ['pergunta', 'vista'];

}
