<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ContactActionsTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(Request $request, Company $company)
    {
        try {
            DB::beginTransaction();

            $contact = new Contact();
            $contact->company_id = $company->id;
            $contact->position_id = $request->position_id;
            $contact->name = $request->name;
            $contact->ddd = $request->ddd;
            $contact->main_phone = $request->main_phone;
            $contact->ddd_fax = $request->ddd_fax;
            $contact->fax = $request->fax;
            $contact->email = $request->email;
            $contact->secondary_email = $request->secondary_email;
            $contact->tertiary_email = $request->tertiary_email;
            $contact->ddd_two = $request->ddd_two;
            $contact->phone_two = $request->phone_two;
            $contact->ddd_three = $request->ddd_three;
            $contact->phone_three = $request->phone_three;
            $contact->ddd_four = $request->ddd_four;
            $contact->phone_four = $request->phone_four;
            $contact->phone_type_one = $request->phone_type_one;
            $contact->phone_type_two = $request->phone_type_two;
            $contact->phone_type_three = $request->phone_type_three;
            $contact->is_active = true;
            $contact->created_by = auth()->guard('web')->user()->id;
            $contact->updated_by = auth()->guard('web')->user()->id;
            $contact->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        session()->flash('success', 'Contato criado.');

        return redirect()->back();
    }

    /**
     * Update an existent resource from the storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request, Contact $contact)
    {
        try {
            DB::beginTransaction();
            
            $contact->position_id = $request->position_id;
            $contact->name = $request->name;
            $contact->ddd = $request->ddd;
            $contact->main_phone = $request->main_phone;
            $contact->ddd_fax = $request->ddd_fax;
            $contact->fax = $request->fax;
            $contact->email = $request->email;
            $contact->secondary_email = $request->secondary_email;
            $contact->tertiary_email = $request->tertiary_email;
            $contact->ddd_two = $request->ddd_two;
            $contact->phone_two = $request->phone_two;
            $contact->ddd_three = $request->ddd_three;
            $contact->phone_three = $request->phone_three;
            $contact->ddd_four = $request->ddd_four;
            $contact->phone_four = $request->phone_four;
            $contact->phone_type_one = $request->phone_type_one;
            $contact->phone_type_two = $request->phone_type_two;
            $contact->phone_type_three = $request->phone_type_three;
            $contact->is_active = true;
            $contact->updated_by = auth()->guard('web')->user()->id;
            $contact->save();

            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        session()->flash('success', 'Contato atualizado.');

        return redirect()->back();
    }
}
