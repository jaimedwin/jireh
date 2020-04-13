<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonanaturalFormRequest extends FormRequest
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
            'codigo'                            => 'required|unique:personanatural|string|max:15', 
            'nombres'                           => 'required|string|max:100', 
            'apellidopaterno'                   => 'nullable|string|max:75', 
            'apellidomaterno'                   => 'nullable|string|max:75',
            'tipodocumentoidentificacion_id'    => 'required|numeric',
            'numerodocumento'                   => 'required|unique:personanatural|string|max:15', 
            'expedicion_id'                     => 'required|numeric',
            'fechaexpedicion'                   => 'nullable|date', 
            'fechanacimiento'                   => 'nullable|date',
            'direccion'                         => 'required|string|max:500', 
            'eps_id'                            => 'required|numeric', 
            'fondodepension_id'                 => 'required|numeric', 
            'grado_id'                          => 'nullable',
            'users_id'                          => 'required|numeric',
            'created_at'                        => 'nullable|date',
            'updated_at'                        => 'nullable|date',
        ];
    }
}
