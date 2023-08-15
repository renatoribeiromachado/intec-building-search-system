<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allPhases($where = [])
    {
        $phase = self::select('phases.*');

        if (request()->description) {
            $where[] = ['phases.description', 'like', '%'.request()->description.'%'];
        }

        return $phase
            ->where($where)
            ->orderBy('phases.id', 'asc')
            ->paginate(15);
    }
}
