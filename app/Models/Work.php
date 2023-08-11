<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    const LARGE_DIR_STORAGE_PATH = 'work';
    const LARGE_PHOTO_IMAGE_WIDTH = 620;
    const LARGE_PHOTO_IMAGE_HEIGHT = 372;
    const RESIDENTIAL_SEGMENT = 'RESIDENCIAL';
    const INDUSTRY_SEGMENT = 'INDUSTRIAL';
    const BUSINESS_SEGMENT = 'COMERCIAL';

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
        'zone',
        'started_at',
        'ends_at',
        'notes',
        'revision',
        'start_and_end',
        'total_project_area',
        'cub',
        'quotation_type',
        'coin',
        'investment_standard',
        'tower', // obr_DescResidEdificio_chr
        'house', // obr_DescResidResidenciais_chr
        'condominium', // obr_DescResidCondominios_chr
        'floor', // obr_DescResidPavimentos_chr
        'apartment_per_floor', // obr_DescResidApartamentos_chr
        'bedroom', // obr_DescResidDormitorios_chr
        'suite', // obr_DescResidSuite_chr
        'bathroom', // obr_DescResidBanheiro_chr
        'washbasin', // obr_DescResidLavabo_chr
        'living_room', // obr_DescResidSala_chr
        'cup_and_kitchen', // obr_DescResidCopa_chr
        'service_area_terrace_balcony', // obr_DescResidATV_chr
        'maid_dependency', // obr_DescResidDepEmpreg_chr
        'other_leisure',
        'total_unities', // obr_DescInfoAdicTotalUnicades_chr
        'useful_area', // obr_DescInfoAdicAreaUtil_chr
        'total_area', // obr_DescInfoAdicAreaTerreno_chr
        'elevator', // obr_DescInfoAdicElevador_chr
        'garage', // obr_DescInfoAdicVagas_chr
        'coverage', // obr_DescInfoAdicCobert_chr
        'air_conditioner', // obr_DescInfoAdicArCondic_chr
        'heating', // obr_DescInfoAdicAquecimento_chr
        'foundry', // obr_DescInfoAdicFundacoes_chr
        'frame', // obr_DescInfoAdicEstrutura_chr
        'completion', // obr_DescInfoAdicAcabamento_chr
        'facade', // obr_DescInfoAdicFachada_chr
        'status',
        'storage_image_link',
        'public_image_link',
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

        // if (request()->search_old_code) {
        //     $where[]  = ['works.old_code', 'like', '%'.request()->search_old_code.'%'];
        // }

        if (request()->name) {
            $work = $work->where('works.name', 'like', '%'.request()->name.'%');
        }

        $work = $work->where($where);

        if (request()->researcher_id) {
            $researcherId = request()->researcher_id;
            // $where[]  = ['works.name', 'like', '%'.request()->name.'%'];
            $work->whereHas('researchers', function ($q) use ($researcherId) {
                return $q->whereIn('researchers.id', [$researcherId]);
            });
        }

        return $work
            ->orderBy('works.id', 'asc')
            ->paginate(50);
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

    public function segmentSubType()
    {
        return $this->belongsTo(SegmentSubType::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    public function features()
    {
        return $this->belongsToMany(WorkFeature::class, 'work_feature_work');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function companyActivityFields()
    {
        return $this->belongsToMany(ActivityField::class)->withPivot('company_id');
    }

    public function companyContacts()
    {
        return $this->belongsToMany(Contact::class)->withPivot('company_id');
    }

    public function researchers()
    {
        return $this->belongsToMany(Researcher::class);
    }
}
