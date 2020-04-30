<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoprocesoFormRequest extends FormRequest
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
            'nombrearchivo'         => 'required|mimes:pdf|unique:documento',
            'tipodocumento_id'      => 'required|numeric',
            'proceso_id'            => 'required|numeric',
            'users_id'              => 'required|numeric',
            'created_at'            => 'nullable|date',
            'updated_at'            => 'nullable|date',
        ];
        
    }
}
