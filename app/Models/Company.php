<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name', // razao
        'trading_name', // fantasia
        'trading_name_slug',
        'minified_name',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'city_registration', // inscr munic
        'state',
        'state_registration', // inscr est
        'state_acronym',
        'zip_code',
        'notes',
        'cnpj',
        'primary_email',
        'secondary_email',
        'home_page',
        'skype',
        'sponsor', // responsável
        'sponsor_slug',
        'company_segment_id',
        'is_active',
        'is_project_owner',
        'image_storage_link',
        'image_public_link',
        'created_by',
        'updated_by',
        'register_ip',
        // 'qtde_funcionarios', // ??
        // 'id_atividade', // ??
        // 'id_subatividade', // ??
        // 'id_pesquisador', // ??
        // 'ind_demo', // ??
        // 'INDSTATUS', // ??
        // 'usuario', // ??
    ];

    // App methods
    public function allCompanies($where = [])
    {

        $where[] = ['is_project_owner', false];
        
        if (request()->search_name) {
            $where[]  = ['companies.company_name', 'like', '%' . request()->search_name . '%'];
            $where2[] = ['companies.trading_name', 'like', '%' . request()->search_name . '%'];
            $where3[] = ['companies.id', request()->search_name];

            return self::select('companies.*')
                ->where($where)
                ->orWhere($where2)
                ->orWhere($where3)
                ->orderBy('companies.id', 'asc')
                ->paginate(10);
        }
        
        $where2 = ['company_name'];

        return self::select('companies.*')
            ->where($where)
            ->whereNotNull($where2)
            ->orderBy('companies.id', 'asc')
            ->paginate(10);
    }

    // Scopes
    public function scopeIsProjectOwner($q, $value)
    {
        return $q->where('is_project_owner', $value);
    }

    // Eloquent relationship methods
    public function unity()
    {
        return $this->hasOne(Unit::class);
    }
}
