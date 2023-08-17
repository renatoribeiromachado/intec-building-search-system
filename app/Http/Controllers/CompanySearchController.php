<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanySearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    public function showWorkSearchStepOne()
    {

        return view('layouts.company.search.step_one.index', compact(
            'stagesOne',
        ));
    }
}
