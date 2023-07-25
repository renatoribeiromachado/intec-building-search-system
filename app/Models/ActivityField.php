<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityField extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allActivityFields($where = [])
    {
        $phase = self::select('activity_fields.*');

        if (request()->description) {
            $where[] = ['activity_fields.description', 'like', '%'.request()->description.'%'];
        }

        return $phase
            ->where($where)
            ->orderBy('activity_fields.id', 'asc')
            ->paginate(15);
    }

    // Eloquent relationship methods
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
