<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySearchSaved extends Model
{
    protected $table = "company_search_saved"; 
    protected $fillable = [
                'search_name',
        	'last_review_from',
                'last_review_to',	
                'states',
                'activity_fields',	
                'search',
                'searchCompany',	
                'address',
                'district',	
                'state_id',	
                'cities_ids',	
                'home_page',	
                'cnpj',	
                'primary_email',	
                'researcher_id',	
                'user_id',	
    ];

    protected $casts = [
        'states' => 'array',
        'activity_fields' => 'array',
        // Adicione outros campos que são arrays conforme necessário...
    ];
    
}
