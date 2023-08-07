<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'work_notes',
        'situation',
        'start_at',
        'ends_at',
        'original_price',
        'discount',
        'final_price',
        'first_due_date',
        'installments',
        'easy_payment_condition',
        'notes',
        'created_by',
        'updated_by',
    ];

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
        ['installment' => 4, 'description' => 'Parcelado em 4x'],
        ['installment' => 5, 'description' => 'Parcelado em 5x'],
        ['installment' => 6, 'description' => 'Parcelado em 6x'],
        ['installment' => 7, 'description' => 'Parcelado em 7x'],
        ['installment' => 8, 'description' => 'Parcelado em 8x'],
        ['installment' => 9, 'description' => 'Parcelado em 9x'],
        ['installment' => 10, 'description' => 'Parcelado em 10x'],
        ['installment' => 11, 'description' => 'Parcelado em 11x'],
        ['installment' => 12, 'description' => 'Parcelado em 12x'],
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
