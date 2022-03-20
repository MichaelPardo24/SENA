<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profile as Person;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
            'names' => ['required', 'string', 'max:45'],
            'surnames' => ['required', 'string', 'max:45'],
            'document_type' => ['required', 'in:C.C, T.I, C.E, Pasaporte'],
            'document' => ['required', 'unique:users','numeric'],
            'password' => $this->passwordRules(),
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['numeric'],
            'direction' => ['string'],
            'birth_at'=>['date', 'before:today'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        User::create([
            'document' => $input['document'],
            'password' => Hash::make($input['password']),
            'email' => $input['email'],
        ]);
        

        $x=User::latest('id')->first();
        Person::create([
            'document' => $input['document'],
            'document_type' => $input['document_type'],
            'names' => $input['names'],
            'surnames' => $input['surnames'],
            'phone' => $input['phone'],
            //'direction' => $input['direction'],
            //'birth_at' => $input['birth_at'],
            'user_id' => $x->id,
        ]);

        return null;
    }
}
