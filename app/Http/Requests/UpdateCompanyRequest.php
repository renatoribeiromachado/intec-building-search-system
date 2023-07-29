<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'company_name' => ['required', 'min:3', 'max:150', "unique:companies,company_name,{$this->company_id},id"],
            'trading_name' => ['required'],
            'revision' => ['required'],
            'cnpj' => ['required'],
            'primary_email' => ['nullable'],
            'secondary_email' => ['nullable'],
            'phone_one' => ['required'],
            'zip_code' => ['required'],
            'address' => ['required'],
            'number' => ['required'],
            'complement' => ['required'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'state_registration' => ['required'],
            'city_registration' => ['required'],
            'activity_field_id' => ['required'],
            'is_active' => ['required'],
            'home_page' => ['nullable'],
            'last_review' => ['required'],
            'researcher_id' => ['required'],
            'notes' => ['required'],
        ];
    }
}
