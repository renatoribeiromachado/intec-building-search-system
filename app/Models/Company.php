<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

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

        $company = self::select('companies.*');

        if (request()->cnpj) {
            $where[]  = ['companies.cnpj', '=', request()->cnpj];
        }

        if (request()->trading_name) {
            $where[]  = ['companies.trading_name', 'like', '%'.request()->trading_name.'%'];
        }

        return $company
            ->where($where)
            ->orderBy('companies.id', 'asc')
            ->get();
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
