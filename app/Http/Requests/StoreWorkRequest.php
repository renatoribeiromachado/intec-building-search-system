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
        $id = $this->segment(3);
        return [
            'old_code' => "required|min:3|max:20|unique:works,old_code,{$id},id",
            'last_review' => ['nullable', 'date_format:d/m/Y'],
            'researcher_id' => 'required',
            'revision' => 'required',
            'name' => "required|unique:works,name,{$id},id",
            'image' => 'image|mimes:jpeg,png|max:2048',
            'zip_code' => 'required',
            'address' => 'required',
            'district' => 'required',
            'number' => 'required',
            'city' => 'required',
            'state' => 'required',
            'segment_id' => 'required',
            'segment_sub_type_id' => 'required',
            'phase_id' => 'required',
            'stage_id' => 'required',
            'started_at' => ['nullable', 'date_format:d/m/Y'],
            'ends_at' => ['nullable', 'date_format:d/m/Y'],
            'start_and_end' => 'required',
            'price' => 'required',
            'investment_standard' => 'required',
            'total_project_area' => 'required',
            'tower' => 'required',
            'house' => 'required',
            'condominium' => 'required',
            'floor' => 'required',
            'apartment_per_floor' => 'required',
            'bedroom' => 'required',
            'suite' => 'required',
            'bathroom' => 'required',
            'washbasin' => 'required',
            'living_room' => 'required',
            'cup_and_kitchen' => 'required',
            'service_area_terrace_balcony' => 'required',
            'maid_dependency' => 'required',
            'recreation_area' => 'required',
            'other_leisure' => 'required',
            'total_unities' => 'required',
            'useful_area' => 'required',
            'total_area' => 'required',
            'elevator' => 'required',
            'garage' => 'required',
            'coverage' => 'required',
            'air_conditioner' => 'required',
            'heating' => 'required',
            'foundry' => 'required',
            'frame' => 'required',
            'completion' => 'required',
            'facade' => 'required',
            'notes' => 'required',
            'status' => 'required' 
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
