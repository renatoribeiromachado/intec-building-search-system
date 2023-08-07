<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SegmentSubType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // App methods
    public function allSegmentSubTypes($where = [])
    {
        $segmentSubType = self::select('segment_sub_types.*');

        if (request()->description) {
            $where[]  = ['segment_sub_types.description', 'like', '%'.request()->description.'%'];
        }

        return $segmentSubType
            ->where($where)
            ->orderBy('segment_sub_types.id', 'asc')
            ->paginate(15);
    }

    // Eloquent relationship methods
    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function associates()
    {
        return $this->belongsToMany(
            Associate::class,
            'associate_segment_sub_type',
            'seg_sub_type_id',
            'associate_id'
        );
    }
}
