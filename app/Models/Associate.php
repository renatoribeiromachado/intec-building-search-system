<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associate extends Model
{
    use HasFactory, SoftDeletes;

    const ASSOCIATE_MANAGER = 'associado-gestora';
    const ASSOCIATE_USER = 'associado-usuario';

    protected $fillable = [
        'old_code',
        'linked_company',
        'business_branch',
        'company_date_birth',
        'data_filter_starts_at',
        'data_filter_ends_at',
        'contract_due_date_start',
        'products_and_services',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'contract_due_date_start',
        'data_filter_starts_at',
        'data_filter_ends_at'
    ];

    // App methods
    public function allAssociates($request, $where = [])
    {
        $associate = self::select('associates.*');

        if ($request->search_old_code) {
            $associate = $associate->where('old_code', $request->search_old_code);
        }

        if ($request->search_cnpj) {
            $associate = $associate
                ->whereHas('company', function ($query) use ($request) {
                    return $query->where('cnpj', 'like', '%'.$request->search_cnpj.'%');
                });
        }

        if ($request->search_company_name) {
            $associate = $associate
                ->whereHas('company', function ($query) use ($request) {
                    return $query->where('company_name', 'like', '%'.$request->search_company_name.'%');
                });
        }

        if ($request->search_trading_name) {
            $associate = $associate
                ->whereHas('company', function ($query) use ($request) {
                    return $query->where('trading_name', 'like', '%'.$request->search_trading_name.'%');
                });
        }

        return $associate->paginate(50);
    }

    // Eloquent relationship methods
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function salesperson()
    {
        return $this->belongsTo(User::class);
    }

    public function states()
    {
        return $this->belongsToMany(State::class);
    }

    public function segmentSubTypes()
    {
        return $this->belongsToMany(
            SegmentSubType::class,
            'associate_segment_sub_type',
            'associate_id',
            'seg_sub_type_id'
        );
    }
}
