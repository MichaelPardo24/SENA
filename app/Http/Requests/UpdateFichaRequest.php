<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFichaRequest extends FormRequest
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
            'code'                   => ['required', 'integer', 'unique:Fichas,code,'. $this->route('ficha')->id],
            'start_school_stage'     => ['required',],
            'end_school_stage'       => ['required',],
            'start_production_stage' => ['required',],
            'end_production_stage'   => ['required',],
            'town'                   => ['required',],
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
