<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'popup';
    protected $fillable = ['title','status', 'description']; // Adicione outros campos conforme necessário
}
