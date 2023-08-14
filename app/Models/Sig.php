<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sig extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'code',
        'appointment_date',
        'user_email',
        'priority',
        'status',
        'note'
    ];

    // Eloquent relationship methods
    public function associates()
    {
        return $this->belongsToMany(Associate::class);
    }
}
