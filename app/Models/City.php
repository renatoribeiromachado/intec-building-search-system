<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description'
    ];

    // App methods
    public function getAllCitiesFromTheState(int $stateId)
    {
        return self::select("*")
            ->where('state_id', $stateId)
            ->get();
    }

    // Eloquente relationship methods
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
