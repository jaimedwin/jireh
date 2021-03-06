<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoFormRequest extends FormRequest
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
            'fecha'         => 'required|date_format:Y-m-d',
            'abono'         => 'required|numeric', 
            'nrecibo'       => 'nullable|unique:pago|string|max:20', 
            'contrato_id'   => 'required|numeric',
            'users_id'      => 'required|numeric',
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
        ];
    }
}
