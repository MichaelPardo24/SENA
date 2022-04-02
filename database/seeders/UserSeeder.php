<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(18)->create();

        foreach (\App\Models\User::take(10)->get() as $user) {
            $user->assignRole('Aprendiz');
        }

        $a = \App\Models\User::find(11);
        $a->assignRole('Instructor Tecnico');

        $a = \App\Models\User::find(12);
        $a->assignRole('Instructor Tecnico');

        $a = \App\Models\User::find(13);
        $a->assignRole('Instructor Tecnico');
// -----------------------------------------------

        $b =\App\Models\User::find(14);
        $b->assignRole('Instructor Seguimiento');
        
        $b =\App\Models\User::find(15);
        $b->assignRole('Instructor Seguimiento');

        $b =\App\Models\User::find(16);
        $b->assignRole('Instructor Seguimiento');
        
        $b =\App\Models\User::find(17);
        $b->assignRole('Manager');
// ----------------------------------------------

        $d =\App\Models\User::find(18);
        $d->assignRole('Coordinador');

        \App\Models\User::create([
            'document' => '123456789',
            'email' => 'manager@mail.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->assignRole('Manager');

        foreach (\App\Models\User::all() as $user) {
            \App\Models\Profile::factory()->create([
                'document' => $user->document,
                'user_id' => $user->id,
            ]);
        }
    }
}
