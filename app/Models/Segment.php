<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allSegments($where = [])
    {
        $segment = self::select('segments.*');

        if (request()->description) {
            $where[] = ['segments.description', 'like', '%'.request()->description.'%'];
        }

        return $segment
            ->where($where)
            ->orderBy('segments.id', 'asc')
            ->paginate(15);
    }

    // Eloquent relationship methods
    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
