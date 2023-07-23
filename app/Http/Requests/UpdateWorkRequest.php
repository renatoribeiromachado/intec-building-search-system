<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkRequest extends FormRequest
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
            'last_review' => ['nullable', 'date_format:m/d/Y']
        ];
    }

    public function messages()
    {
        return [
            'last_review.date_format' => 'Data inválida'
        ];
    }
}
