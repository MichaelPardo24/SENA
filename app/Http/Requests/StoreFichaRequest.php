<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFichaRequest extends FormRequest
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
            'program_id'             => ['required', 'integer','exists:Programs,id'],
            'code'                   => ['required', 'integer', 'unique:fichas,code'],
            'start_school_stage'     => ['required',],
            'end_school_stage'       => ['required', 'after:start_school_stage'],
            'start_production_stage' => ['required', 'after:end_school_stage'],
            'end_production_stage'   => ['required', 'after:start_production_stage'],
            'town'                   => ['required', Rule::in([
                'Ibagué',
                'Espinal',
                ])],
            'type'                   => ['required', Rule::in([
                'Auxiliar',
                'Espc. Tecnologica',
                'Operario',
                'Profundizacion Tecnica',
                'Tecnologo',
                'Tecnico'
                ])],
        ];
    }
}
