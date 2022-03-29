<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
// ----------------------------------------------

        $c =\App\Models\User::find(17);
        $c->assignRole('Manager');

        $d =\App\Models\User::find(18);
        $d->assignRole('Coordinador');


        foreach (\App\Models\User::all() as $user) {
            \App\Models\Profile::factory()->create([
                'document' => $user->document,
                'user_id' => $user->id,
            ]);
        }
    }
}
