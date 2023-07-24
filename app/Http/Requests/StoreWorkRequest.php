<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
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
            'last_review' => ['nullable', 'date_format:d/m/Y'],
            'started_at' => ['nullable', 'date_format:d/m/Y'],
            'ends_at' => ['nullable', 'date_format:d/m/Y']
        ];
    }

    public function messages()
    {
        return [
            'last_review.date_format' => 'Data de Publicação inválida',
            'started_at.date_format' => 'Data de Início da Obra inválida',
            'ends_at.date_format' => 'Data Término da Obra inválida'
        ];
    }
}
