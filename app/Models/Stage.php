<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'created_by',
        'updated_by',
    ];

    // App methods
    public function allStages($where = [])
    {
        $stage = self::select('stages.*');

        if (request()->description) {
            $where[]  = ['stages.description', 'like', '%'.request()->description.'%'];
        }

        return $stage
            ->where($where)
            ->orderBy('stages.id', 'asc')
            ->paginate(1);
    }
}
