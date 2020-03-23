<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarreraFormRequest extends FormRequest
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
            'abreviatura'   => 'required|string|max:10',
            'descripcion'   => 'required|string|max:50', 
            'fuerza_id'     => 'required|numeric',
            'users_id'      => 'required|numeric',
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
        ];
    }
}
