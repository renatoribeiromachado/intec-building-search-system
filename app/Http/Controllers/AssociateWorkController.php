<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Stage;
use Illuminate\Http\Request;

class AssociateWorkController extends Controller
{
    protected $stage;

    public function __construct(
        Stage $stage
    ) {
        $this->stage = $stage;
    }

    public function __invoke()
    {
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();

        return view('layouts.customer_area.search-work', compact(
            'stagesOne',
            'stagesTwo',
            'stagesThree',
        ));
    }
}
