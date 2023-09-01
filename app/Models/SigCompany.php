<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SigCompany extends Model
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
    
    protected $table = "sig_companies"; 

    protected $fillable = [
        'user_id',
        'company_id',
        'associate_id',
        'appointment_date',
        'priority',
        'status',
        'notes',
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    
}
