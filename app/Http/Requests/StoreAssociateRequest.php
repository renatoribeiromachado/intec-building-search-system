<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssociateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => ['required', 'min:3', 'max:150', 'unique:companies,company_name'],
            'trading_name' => ['required'],
            'cnpj' => ['required'],
            'primary_email' => ['required', 'email'],
            'phone_one' => ['required'],
            'zip_code' => ['required'],
            'address' => ['required'],
            'number' => ['required'],
            'complement' => ['required'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'state_registration' => ['required'],
            'activity_field_id' => ['required'],
            'is_active' => ['required'],
            'home_page' => ['required'],
            'notes' => ['required'],
            'business_branch' => ['required'],
            'contract_due_date_start' => ['required', 'date_format:d/m/Y'],
            'products_and_services' => ['required'],
            'salesperson_id' => ['required'],
            'company_date_birth' => ['required'],
        ];
    }
}
