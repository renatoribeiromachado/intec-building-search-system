<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $associate;

    public function __construct(
        Associate $associate
    ) {
        $this->associate = $associate;
    }

    public function store(Request $request, Associate $associate)
    {
        $associate->states()->sync($request->states);
        $associate->segmentSubTypes()->sync($request->segment_sub_types);

        session()->flash('success', 'Dados da assinatura atualizados.');

        return redirect()->back();
    }
}
