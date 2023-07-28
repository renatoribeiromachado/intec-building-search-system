<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Researcher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    // App methods
    public function allResearchers($where = [])
    {
        $phase = self::select('researchers.*');

        if (request()->name) {
            $where[] = ['researchers.name', 'like', '%'.request()->name.'%'];
        }

        return $phase
            ->where($where)
            ->orderBy('researchers.id', 'asc')
            ->paginate(15);
    }
}
