<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    use HasFactory;

    protected $fillable = [
        'linked_company',
        'business_branch',
        'company_date_birth',
        'contract_due_date_start',
        'products_and_services',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'contract_due_date_start'
    ];

    // App methods
    public function allAssociates($request, $where = [])
    {
        $associate = self::select('associates.*');

        if ($request->search_id) {
            $associate = $associate->where('id', $request->search_id);
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
}
