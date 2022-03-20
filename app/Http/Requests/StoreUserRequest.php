<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'document_type' => ['required', 'in:C.C, T.I, C.E, Pasaporte'],
            'document' => ['required', 'numeric'],
            'password' => $this->passwordRules(),
            'email' => ['string', 'max:255'],
            'phone' => ['numeric'],
            'direction' => ['string'],
            'birth_at'=>['date', 'before:today'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];
    }
}
