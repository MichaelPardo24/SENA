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
            'change_role',

            'users_edit',
            'users_create',
            'users_destroy',
            'users_status',
            'users_index',

            'files_show',
            'files_edit',
            'files_create',
            'files_delete',
            'files_index',
            
            'fichas_show',
            'fichas_edit',
            'fichas_create',
            'fichas_delete',
            'fichas_index',

            'programs_index',
            'programs_edit',
            'programs_create',
            'programs_delete',

            'file-types_show',
            'file-types_edit',
            'file-types_create',
            'file-types_delete',
            'file-types_index',

            'follow-ups_show',
            'follow-ups_edit',
            'follow-ups_create',
            'follow-ups_delete',
            'follow-ups_index',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Instructor Tecnico'])
                ->givePermissionTo([
                    'users_edit',
                    'users_create',
                    'users_destroy',
                    'users_status',
                    'users_index',
                    'programs_index',
                    'file-types_show',
                    'file-types_index',
                    'fichas_index',
                ]);

        $role = Role::create(['name' => 'Instructor Seguimiento'])
                ->givePermissionTo([
                    'users_edit',
                    'users_status',
                    'users_index',
                    'follow-ups_show',
                    'follow-ups_edit',
                    'follow-ups_create',
                    'follow-ups_delete',
                    'follow-ups_index',
            ]);
        
        $role = Role::create(['name' => 'Coordinador'])
            ->givePermissionTo([
                'users_edit',
                'users_create',
                'users_destroy',
                'users_status',
                'users_index',
                'files_show',
                'files_edit',
                'files_create',
                'files_delete',
                'files_index',
                'change_role',
            ]);

        $role = Role::create(['name' => 'Manager'])
            ->givePermissionTo([
                'change_role',
                'users_edit',
                'users_create',
                'users_destroy',
                'users_status',
                'users_index',
                'files_show',
                'files_edit',
                'files_create',
                'files_delete',
                'files_index',
                'fichas_show',
                'fichas_edit',
                'fichas_create',
                'fichas_delete',
                'fichas_index',
                'programs_index',
                'programs_edit',
                'programs_create',
                'programs_delete',
                'file-types_show',
                'file-types_edit',
                'file-types_create',
                'file-types_delete',
                'file-types_index',
                'follow-ups_show',
                'follow-ups_edit',
                'follow-ups_create',
                'follow-ups_delete',
                'follow-ups_index',
            ]);
        
        $role = Role::create(['name' => 'Aprendiz'])->givePermissionTo([
            'files_show',
            'files_edit',
            'files_create',
            'files_delete',
            // 'files_access',
        ]);
    }
}
