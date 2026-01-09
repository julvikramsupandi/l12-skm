<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'superadmin',
            'admin',
            // dashboard
            'dashboard.view',

            // user 
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // role
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // element
            'element.view',
            'element.create',
            'element.edit',
            'element.delete',

            // answer option
            'answer-option.view',
            'answer-option.create',
            'answer-option.edit',
            'answer-option.delete',

            // question
            'question.view',
            'question.create',
            'question.edit',
            'question.delete',

            // unor
            'unor.view',
            'unor.create',
            'unor.edit',
            'unor.delete',

            // skm
            'skm.view',
            'skm.show',
            'skm.show-by-unor',
            'skm.create',
            'skm.edit',
            'skm.delete',

            // ikm
            'ikm.view',

            // service
            'service.view',
            'service.create',
            'service.edit',
            'service.delete',

            // report
            'report.analytic-respondent',
            'report.analytic-respondent-by-unor',

            'report.ikm-by-service',
            'report.ikm-by-service-by-unor',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }


        // ================= ROLES =================
        $superAdmin = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $operator = Role::firstOrCreate(['name' => 'Operator']);
        $user = Role::firstOrCreate(['name' => 'User']);

        // ================= ROLE PERMISSIONS =================
        // SUPER ADMIN → SEMUA PERMISSION
        // $superAdmin->syncPermissions(Permission::whereNotIn('name', [
        //     'skm.show-by-unor',
        //     'report.analytic-respondent-by-unor',
        // ]));
        $superAdmin->syncPermissions(Permission::whereNotIn('name', [
            'skm.show-by-unor',
            'report.analytic-respondent-by-unor',
            'report.ikm-by-service-by-unor',
        ])->get());

        // ADMIN → SEMUA PERMISSION
        $admin->syncPermissions(Permission::whereNotIn('name', [
            'superadmin',
            'skm.show-by-unor',
            'report.analytic-respondent-by-unor',
            'report.ikm-by-service-by-unor',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.view',
            'role.create',
            'role.edit',
        ])->get());

        // OPERATOR → SEMUA PERMISSION
        $operator->syncPermissions([
            'dashboard.view',
            'ikm.view',
            'service.view',
            'service.create',
            'service.edit',
            'service.delete',
            'skm.show-by-unor',
            'report.analytic-respondent-by-unor',
            'report.ikm-by-service-by-unor',
        ]);

        // ADMIN → TANPA USER dan ROLE MANAGEMENT
        $user->syncPermissions([
            'dashboard.view',
        ]);
    }
}
