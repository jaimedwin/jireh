<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipodocumentoFormRequest extends FormRequest
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
            'abreviatura'   => 'required|unique:tipodocumento|string|max:5',
            'descripcion'   => 'required|string|max:30',
            'comentario'    => 'nullable|string|max:1000',
            'users_id'      => 'required|numeric',
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
        ];
    }
}
