<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensalResult extends Model
{
    protected $table = 'mensal_results';
    protected $fillable = ['new_works','residencial','comercial','industrial']; // Adicione outros campos conforme necessário
}
