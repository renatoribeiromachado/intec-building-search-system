<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Work;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $work;
    protected $segment;

    public function __construct(
        Work $work,
        Segment $segment,
    ) {
        $this->work = $work;
        $this->segment = $segment;
    }

    public function __invoke()
    {
        $worksInBrazil = number_format(
            $this->work->count(), 0, '', '.'
        );
        $residentialWorks = number_format(
            $this->segment
            ->where('description', '=', Work::RESIDENTIAL_SEGMENT)
            ->first()->works()->count(), 0, '', '.'
        );
        $industrialWorks = number_format(
            $this->segment
            ->where('description', '=', Work::INDUSTRY_SEGMENT)
            ->first()->works()->count(), 0, '', '.'
        );
        $businessWorks = number_format(
            $this->segment
            ->where('description', '=', Work::BUSINESS_SEGMENT)
            ->first()->works()->count(), 0, '', '.'
        );
        
        return view('layouts.dashboard.index', compact(
            'worksInBrazil',
            'residentialWorks',
            'industrialWorks',
            'businessWorks',
        ));
    }
}
