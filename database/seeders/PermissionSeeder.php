<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [


            //users
            'create_users',
            'read_users',
            'update_users',
            'delete_users',

            //employees
            'create_employees',
            'read_employees',
            'update_employees',
            'delete_employees',

            //services
            'create_services',
            'read_services',
            'update_services',
            'delete_services',

            //subscriptions
            'create_subscriptions',
            'read_subscriptions',
            'update_subscriptions',
            'delete_subscriptions',

            //user_subscriptions
            'create_user_subscriptions',
            'read_user_subscriptions',
            'update_user_subscriptions',
            'renew_user_subscriptions',
            'delete_user_subscriptions',


            //catch_receipts
            'create_catch_receipts',
            'read_catch_receipts',
            'update_catch_receipts',
            'delete_catch_receipts',


            //receipts
            'create_receipts',
            'read_receipts',
            'update_receipts',
            'delete_receipts',

            //expenses
            'create_expenses',
            'read_expenses',
            'update_expenses',
            'delete_expenses',

            //Report
            'read_report_receipts',
            'read_report_catch_receipts',
            'read_report_expenses',
            'read_report_subscriptions',

            //settings
            'read_settings',


            //admins
            'create_admins',
            'read_admins',
            'update_admins',
            'delete_admins',

            //roles
            'create_roles',
            'read_roles',
            'update_roles',
            'delete_roles',

            //active
            'read_actives',

        ];


        foreach ($permissions as $permission) {

            Permission::create(['guard_name' => 'admin', 'name' => $permission]);
        }

    }
}
