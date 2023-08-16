<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sig extends Model
{
    use HasFactory, SoftDeletes;

    const STATUSES = [
        'Em contato',
        'Em negociação',
        'Pedido efetivado',
        'Proposta enviada',
        'Sem interesse',
    ];

    const PRIORITIES = [
        'Baixa',
        'Média',
        'Alta',
    ];

    protected $fillable = [
        'user_id',
        'work_id',
        'appointment_date',
        'priority',
        'status',
        'note',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'appointment_date'
    ];

    // Eloquent relationship methods
    public function associate()
    {
        return $this->belongsTo(Associate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
