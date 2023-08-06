<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allPositions($where = [])
    {
        $phase = self::select('positions.*');

        if (request()->description) {
            $where[] = ['positions.description', 'like', '%'.request()->description.'%'];
        }

        return $phase
            ->where($where)
            ->orderBy('positions.id', 'asc')
            ->paginate(15);
    }

    public function getPositionList()
    {
        return self::select('id', 'description')
            ->orderBy('description', 'asc')
            ->get()->pluck('description', 'id');
    }
}
