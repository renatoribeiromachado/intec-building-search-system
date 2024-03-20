<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Work;
use App\Models\QuarterlyResult;
use App\Models\KnowMore;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $work;
    protected $segment;
    protected $quarterly;
    protected $know;

    public function __construct(
        Work $work,
        Segment $segment,
        QuarterlyResult $quarterly,
        KnowMore $know
    ) {
        $this->work = $work;
        $this->segment = $segment;
        $this->quarterly = $quarterly;
        $this->know = $know;
    }

    public function __invoke()
    {
        $worksInBrazil = number_format(
            $this->work->whereIn('phase_id', [1, 2])
               ->whereNull('deleted_at') // Adiciona a condição deleted_at IS NULL
               ->count(),0,'','.');

        $residentialWorks = number_format(
            $this->segment
                ->where('description', '=', Work::RESIDENTIAL_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $industrialWorks = number_format(
            $this->segment
                ->where('description', '=', Work::INDUSTRY_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $businessWorks = number_format(
            $this->segment
                ->where('description', '=', Work::BUSINESS_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        /*Região norte - total de obras */
        $northWorksCount = number_format(
            $this->work
                ->where('zone', 'NORTE')
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $northResidentialWorks = number_format(
            $this->work
                ->where('zone', 'NORTE')
                ->where('segment_id', 3)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'', '.'
        );

        $northComercialWorks = number_format(
            $this->work
                ->where('zone', 'NORTE')
                ->where('segment_id', 2)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $northIndustrialWorks = number_format(
            $this->work
                ->where('zone', '=', 'NORTE')
                ->where('segment_id', 1)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        /*Região nordeste - total de obras */
        $northeastWorksCount = number_format(
            $this->work
                ->where('zone', 'NORDESTE')
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $northeastResidentialWorks = number_format(
            $this->work
                ->where('zone', 'NORDESTE')
                ->where('segment_id', 3)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $northeastComercialWorks = number_format(
            $this->work
                ->where('zone', 'NORDESTE')
                ->where('segment_id', 2)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $northeastIndustrialWorks = number_format(
            $this->work
                ->where('zone', 'NORDESTE')
                ->where('segment_id', 1)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        /*Região sul - total de obras */
        $southWorksCount = number_format(
            $this->work
                ->where('zone', 'SUL')
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southResidentialWorks = number_format(
            $this->work
                ->where('zone', 'SUL')
                ->where('segment_id', 3)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southComercialWorks = number_format(
            $this->work
                ->where('zone', 'SUL')
                ->where('segment_id', 2)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southIndustrialWorks = number_format(
            $this->work
                ->where('zone', 'SUL')
                ->where('segment_id', 1)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        /*Região sudeste - total de obras */
        $southeastWorksCount = number_format(
            $this->work
                ->where('zone', 'SUDESTE')
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southeastResidentialWorks = number_format(
            $this->work
                ->where('zone', 'SUDESTE')
                ->where('segment_id', 3)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southeastComercialWorks = number_format(
            $this->work
                ->where('zone', 'SUDESTE')
                ->where('segment_id', 2)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $southeastIndustrialWorks = number_format(
            $this->work
                ->where('zone', 'SUDESTE')
                ->where('segment_id', 1)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        /*Região centro-oeste - total de obras */
        $midwestWorksCount = number_format(
            $this->work
                ->where('zone', 'CENTRO-OESTE')
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $midwestResidentialWorks = number_format(
            $this->work
                ->where('zone', 'CENTRO-OESTE')
                ->where('segment_id', 3)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $midwestComercialWorks = number_format(
            $this->work
                ->where('zone', 'CENTRO-OESTE')
                ->where('segment_id', 2)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'','.'
        );

        $midwestIndustrialWorks = number_format(
            $this->work
                ->where('zone', 'CENTRO-OESTE')
                ->where('segment_id', 1)
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),0,'', '.'
        );

        /*Analise mensal/trimestral*/
        $quarterlyResults = $this->quarterly->get();

        /*Saiba mais*/
        $knows = $this->know->get();

        return view('layouts.dashboard.index', compact(
            'worksInBrazil',
            'residentialWorks',
            'industrialWorks',
            'businessWorks',
            'northeastWorksCount',
            'northWorksCount',
            'southWorksCount',
            'southeastWorksCount',
            'midwestWorksCount',
            'northResidentialWorks',
            'northComercialWorks',
            'northIndustrialWorks',
            'northeastResidentialWorks',
            'northeastComercialWorks',
            'northeastIndustrialWorks',
            'southResidentialWorks',
            'southComercialWorks',
            'southIndustrialWorks',
            'southeastResidentialWorks',
            'southeastComercialWorks',
            'southeastIndustrialWorks', 
            'midwestResidentialWorks',
            'midwestComercialWorks',
            'midwestIndustrialWorks',
            'quarterlyResults',
            'knows'
        ));
    }
}
