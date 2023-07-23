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
        'old_code',
        'last_review',
        'name',
        'price',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'last_review'
    ];

    // App methods
    public function allWorks($where = [])
    {
        $work = self::select('works.*');

        // if (request()->cnpj) {
        //     $where[]  = ['companies.cnpj', '=', request()->cnpj];
        // }

        // if (request()->trading_name) {
        //     $where[]  = ['companies.trading_name', 'like', '%'.request()->trading_name.'%'];
        // }

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
}
