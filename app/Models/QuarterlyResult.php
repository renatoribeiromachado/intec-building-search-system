<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuarterlyResult extends Model
{
    protected $table = 'quarterly_result';
    protected $fillable = ['image','pdf']; // Adicione outros campos conforme necessário
}
