<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkSearchStepTwoRequest extends FormRequest
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
            'last_review_from' => ['required', 'date', 'before_or_equal:last_review_to'],
            'last_review_to' => ['required', 'date', 'after_or_equal:last_review_from'],
        ];
    }

    public function messages()
    {
        return [
            'last_review_from.date' => 'Data Inicial inválida.',
            'last_review_to.date' => 'Data Final inválida.',
            'last_review_from.before_or_equal' => 'A Data Inicial informada é maior que a Data Final.',
            'last_review_to.after_or_equal' => 'A Data Final informada é menor que a Data Inicial.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'last_review_from' => convertPtBrDateToEnDate($this->last_review_from),
            'last_review_to' => convertPtBrDateToEnDate($this->last_review_to),
        ]);
    }
}
