<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'plan_id' => ['required'],
            'work_notes' => ['required'],
            'situation' => ['required'],
            'start_at' => ['required', 'date_format:d/m/Y'],
            'ends_at' => ['required', 'date_format:d/m/Y'],
            'original_price' => ['required'],
            'discount' => ['required'],
            'final_price' => ['required'],
            'first_due_date' => ['required', 'date_format:d/m/Y'],
            'installments' => ['required'],
            'easy_payment_condition' => ['required'],
            'notes' => ['required'],
        ];
    }
}
