<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const ORDER_SITUATIONS = [
        ['description' => 'Novo'],
        ['description' => 'Upgrade'],
        ['description' => 'Renovação'],
        ['description' => 'Retorno']
    ];

    const ORDER_INSTALLMENTS = [
        ['installment' => 1, 'description' => 'Parcelado em 1x'],
        ['installment' => 2, 'description' => 'Parcelado em 2x'],
        ['installment' => 3, 'description' => 'Parcelado em 3x'],
    ];

    protected $dates = [
        'start_at',
        'ends_at',
        'first_due_date',
    ];

    // Eloquent relationship methods
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
