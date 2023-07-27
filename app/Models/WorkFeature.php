<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allWorkFeatures($where = [])
    {
        $stage = self::select('work_features.*');

        if (request()->description) {
            $where[]  = ['work_features.description', 'like', '%'.request()->description.'%'];
        }

        return $stage
            ->where($where)
            ->orderBy('work_features.id', 'asc')
            ->paginate(15);
    }

    // Eloquent relationship methods
    public function works()
    {
        return $this->belongsToMany(Work::class, 'work_feature_work');
    }
}
