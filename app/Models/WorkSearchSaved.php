<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSearchSaved extends Model
{
    protected $table = "work_search_saved"; 
    protected $fillable = [
        //'input_select_all',
        //'input_page_of_pagination',
        //'clicked_in_page',
        'search_name',
        'last_review_from',
        'last_review_to',
        'investment_standard',
        'name',
        'old_code',
        'address',
        'district',
        'qa',
        'total_area',
        'qi',
        'price',
        'qr',
        'state_id',
        'cities_ids',
        'researcher_id',
        'revision',
        'search',
        'modality_id',
        'floor',
        'states',
        'segment_sub_types',
        'stages',
        'user_id',
    ];

    protected $casts = [
        'states' => 'array',
        'segment_sub_types' => 'array',
        'stages' => 'array',
        // Adicione outros campos que são arrays conforme necessário...
    ];
    
}
