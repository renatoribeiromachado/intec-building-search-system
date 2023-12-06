<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    protected $table = "login_histories_prod";
    protected $fillable = [
        'user_id',
        'associate_id',
        'ip',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function associate()
    {
        return $this->belongsTo(Associate::class);
    }
}
