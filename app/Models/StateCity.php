<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCity extends Model
{
    use HasFactory;
    
     protected $table = "state_cities"; 
    protected $fillable = [];

    // Eloquent relationship methods
    public function associates()
    {
        return $this->belongsToMany(Associate::class);
    }
}
