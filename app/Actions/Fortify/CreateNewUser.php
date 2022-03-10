<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'names' => ['required', 'string', 'max:50'],
            'surnames' => ['required', 'string', 'max:50'],
            'document' => ['required', 'string', 'max:20'],
            'password' => $this->passwordRules(),
            'email' => ['string', 'max:255'],
            'phone' => ['string', 'max:20'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'names' => $input['names'],
            'surnames' => $input['surnames'],
            'document' => $input['document'],
            'password' => Hash::make($input['password']),
            'email' => $input['email'],
            'phone' => $input['phone'],
        ]);
    }
}
