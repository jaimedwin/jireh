<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonajuridicaFormRequest extends FormRequest
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
            'nit'                   => 'required|string|max:35', 
            'razonsocial'           => 'required|string|max:500', 
            'direccion'             => 'nullable|string|max:500', 
            'personanatural_id'     => 'required|numeric',
            'users_id'              => 'required|numeric',
            'created_at'            => 'nullable|date',
            'updated_at'            => 'nullable|date',
        ];
    }
}
