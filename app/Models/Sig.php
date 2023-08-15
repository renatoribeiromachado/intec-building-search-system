<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sig extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'work_id',
        'code',
        'appointment_date',
        'priority',
        'status',
        'note'
    ];

    // Eloquent relationship methods
    public function associates()
    {
        return $this->belongsToMany(Associate::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
