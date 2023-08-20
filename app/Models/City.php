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
    public function getAllCitiesFromTheState($stateAcronym)
    {
        $state = (new State)
            ->select('id', 'state_acronym')
            ->where('state_acronym', '=', $stateAcronym)
            ->first();

        return self::select("*")
            ->select('id', 'description')
            ->where('state_id', $state->id)
            ->get();
    }

    // Eloquente relationship methods
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function associates()
    {
        return $this->belongsToMany(Associate::class);
    }
}
