<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'names' => ['required', 'string', 'max:45'],
            'surnames' => ['required', 'string', 'max:45'],
            'document_type' => ['required'],
            'document' => ['required', 'numeric'],
            'password' => [],
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['numeric'],
            'direction' => ['string'],
            'birth_at'=>['date', 'before:today']
        ];
    }
}
