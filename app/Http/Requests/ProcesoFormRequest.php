<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcesoFormRequest extends FormRequest
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
            'codigo'            => 'required|unique:proceso|string|max:15',
            'numero'            => 'required|unique:proceso|string|max:35',
            'ciudadproceso_id'  => 'required|numeric',
            'corporacion_id'    => 'required|numeric', 
            'ponente_id'        => 'required|numeric', 
            'estado_id'         => 'required|numeric',
            'users_id'          => 'required|numeric',
            'created_at'        => 'nullable|date',
            'updated_at'        => 'nullable|date',
        ];
    }
}
