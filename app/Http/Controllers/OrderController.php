<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Company;
use App\Models\Order;
use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $plan;
    protected $order;

    public function __construct(
        Plan $plan,
        Order $order,
    ) {
        $this->plan = $plan;
        $this->order = $order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Company $company)
    {
        $order = $this->plan;
        $situations = collect(Order::ORDER_SITUATIONS)
            ->pluck('description', 'description');

        $plans = $this->plan->pluck('description', 'id');

        $installments = collect(Order::ORDER_INSTALLMENTS)
            ->pluck('description', 'installment');

        return view('layouts.order.create', compact(
            'order',
            'company',
            'situations',
            'plans',
            'installments',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, Company $company)
    {
        try {

            DB::beginTransaction();

            $order = $this->order;
            $order->company_id = $company->id;
            $order->plan_id = $request->plan_id;
            $order->work_notes = $request->work_notes;
            $order->situation = $request->situation;
            $order->start_at = convertPtBrDateToEnDate($request->start_at);
            $order->ends_at = convertPtBrDateToEnDate($request->ends_at);
            $order->original_price = convertMaskToDecimal($request->original_price);
            $order->discount = convertMaskToDecimal($request->discount);
            $order->final_price = convertMaskToDecimal($request->final_price);
            $order->first_due_date = convertPtBrDateToEnDate($request->first_due_date);
            $order->installments = $request->installments;
            $order->easy_payment_condition = $request->easy_payment_condition;
            $order->notes = $request->notes;
            $order->created_by = auth()->user()->id;
            $order->updated_by = auth()->user()->id;
            $order->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);

        }

        session()->flash('success', 'Pedido criado.');

        return redirect()->route('associate.edit', $company->associate->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Company $company, Order $order)
    {
        try {

            DB::beginTransaction();

            $order->plan_id = $request->plan_id;
            $order->work_notes = $request->work_notes;
            $order->situation = $request->situation;
            $order->start_at = convertPtBrDateToEnDate($request->start_at);
            $order->ends_at = convertPtBrDateToEnDate($request->ends_at);
            $order->original_price = convertMaskToDecimal($request->original_price);
            $order->discount = convertMaskToDecimal($request->discount);
            $order->final_price = convertMaskToDecimal($request->final_price);
            $order->first_due_date = convertPtBrDateToEnDate($request->first_due_date);
            $order->installments = $request->installments;
            $order->easy_payment_condition = $request->easy_payment_condition;
            $order->notes = $request->notes;
            $order->updated_by = auth()->user()->id;
            $order->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);

        }

        session()->flash('success', 'Pedido atualizado.');

        return redirect()->route('associate.edit', $company->associate->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company, Order $order)
    {
        try {
            DB::beginTransaction();

            $order->whereCompanyId($company->id)->delete();

            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        session()->flash('success', 'Pedido excluído.');

        return redirect()->route('associate.edit', $company->associate->id);
    }
}
