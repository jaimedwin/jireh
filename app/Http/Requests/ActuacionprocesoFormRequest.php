<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActuacionprocesoFormRequest extends FormRequest
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
            'fechaactuacion'        => 'required|date_format:Y-m-d',
            'actuacion'             => 'required|string|max:250', 
            'anotacion'             => 'nullable|string|max:1000',
            'nombrearchivo'         => 'nullable|mimes:pdf,doc,docx|max:204800', 
            'fechainiciatermino'    => 'nullable|date_format:Y-m-d', 
            'fechafinalizatermino'  => 'nullable|date_format:Y-m-d', 
            'fecharegistro'         => 'required|date_format:Y-m-d', 
            'proceso_id'            => 'required|numeric', 
            'users_id'              => 'required|numeric',
            'created_at'            => 'nullable|date',
            'updated_at'            => 'nullable|date',
        ];
    }
}
