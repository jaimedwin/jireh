<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipodocumentoidentificacionFormRequest extends FormRequest
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
            'abreviatura'   => 'required|unique:tipodocumentoidentificacion|string|max:10',
            'descripcion'   => 'required|string|max:200',
            'users_id'      => 'required|numeric',
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
        ];
    }
}
