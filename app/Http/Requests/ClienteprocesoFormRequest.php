<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClienteprocesoFormRequest extends FormRequest
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
        Validator::extend('unique_multiple', function ($attribute, $value, $parameters, $validator)
        {
            //if this is for an update then don't validate
            //todo: this might be an issue if we allow people to "update" one of the columns..but currently these are getting set on create only
            if (isset($validator->getData()['id'])) return true;

            // Get table name from first parameter
            $table = array_shift($parameters);

            // Build the query
            $query = DB::table($table);

            // Add the field conditions
            foreach ($parameters as $i => $field){
                $query->where($field, $validator->getData()[$field]);
            }

            // Validation result will be false if any rows match the combination
            return ($query->count() == 0);

        });

        return [
            'personanatural_id' =>  'required|numeric|unique_multiple:clienteproceso,personanatural_id,proceso_id',
            'proceso_id'        =>  'required|numeric|unique_multiple:clienteproceso,personanatural_id,proceso_id', 
            'tipodemanda_id'    =>  'required|numeric',
            'box_id'            =>  'required|numeric',
            'users_id'          =>  'required|numeric',
            'created_at'        =>  'nullable|date',
            'updated_at'        =>  'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'personanatural_id.unique_multiple' => 'Existe una persona natural vinculada con el mismo proceso',
            'proceso_id.unique_multiple' => 'Existe un proceso vinculado con la misma persona natural'
        ];
    }
}
