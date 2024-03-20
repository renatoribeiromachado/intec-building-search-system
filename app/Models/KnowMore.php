<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowMore extends Model
{
    protected $table = 'know_more';
    protected $fillable = ['image','title','description']; // Adicione outros campos conforme necessário
}
