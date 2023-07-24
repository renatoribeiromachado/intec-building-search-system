<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phase_id',
        'stage_id',
        'segment_id',
        'segment_sub_type_id',
        'old_code',
        'last_review',
        'name',
        'price',
        'address',
        'number',
        'district',
        'city',
        'state',
        'state_acronym',
        'zip_code',
        'started_at',
        'ends_at',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'last_review',
        'started_at',
        'ends_at',
    ];

    // App methods
    public function allWorks($where = [])
    {
        $work = self::select('works.*');

        // if (request()->cnpj) {
        //     $where[]  = ['companies.cnpj', '=', request()->cnpj];
        // }

        if (request()->name) {
            $where[]  = ['works.name', 'like', '%'.request()->name.'%'];
        }

        return $work
            ->where($where)
            ->orderBy('works.id', 'asc')
            ->paginate(15);
    }

    // Eloquent relationship methods
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }
}
