<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        Request $request,
        Company $company,
        Order $order
    ) {
        $contacts = $order
            ->company
            ->contacts()
            ->whereDoesntHave('user')
            ->get();

        $associateUsers = $order
            ->company
            ->contacts()
            ->whereHas('user')
            ->get();

        return view('layouts.order.report.index', compact(
            'order',
            'contacts',
            'associateUsers'
        ));
    }
}
