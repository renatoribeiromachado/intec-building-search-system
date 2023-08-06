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

    // Eloquent relationship methods
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
