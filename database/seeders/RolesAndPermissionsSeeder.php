<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users_show',
            'users_update',
            'users_create',
            'users_delete',
            'users_status',
            'users_access',

            'files_show',
            'files_update',
            'files_create',
            'files_delete',
            'files_access',
            
            'fichas_show',
            'fichas_update',
            'fichas_create',
            'fichas_delete',
            'fichas_access',

            'program_show',
            'program_update',
            'program_create',
            'program_delete',
            'program_access',

            'file-type_show',
            'file-type_update',
            'file-type_create',
            'file-type_delete',
            'file-type_access',

            'follow-ups_show',
            'follow-ups_update',
            'follow-ups_create',
            'follow-ups_delete',
            'follow-ups_access',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Instructor Tecnico'])
                ->givePermissionTo([
                    'users_show',
                    'users_update',
                    'users_create',
                    'users_status',
                    'users_access',
                ]);

        $role = Role::create(['name' => 'Instructor Seguimiento'])
                ->givePermissionTo([
                    'users_show',
                    'users_status',
                    'users_access',
                    'follow-ups_show',
                    'follow-ups_update',
                    'follow-ups_create',
                    'follow-ups_delete',
                    'follow-ups_access',
            ]);
        
        $role = Role::create(['name' => 'Coordinador'])
            ->givePermissionTo([
                'users_show',
                'users_status',
                'users_access',
                'files_show',
                'files_update',
                'files_create',
                'files_delete',
                'files_access',
            ]);

        $role = Role::create(['name' => 'Manager'])
            ->givePermissionTo([
                'fichas_show',
                'fichas_update',
                'fichas_create',
                'fichas_delete',
                'fichas_access',
                'program_show',
                'program_update',
                'program_create',
                'program_delete',
                'program_access',
                'file-type_show',
                'file-type_update',
                'file-type_create',
                'file-type_delete',
                'file-type_access',
            ]);
        
        $role = Role::create(['name' => 'Aprendiz'])->givePermissionTo([
            'files_show',
            'files_update',
            'files_create',
            'files_delete',
            // 'files_access',
        ]);
    }
}
