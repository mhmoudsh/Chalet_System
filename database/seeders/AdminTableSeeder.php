<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name'=>'super admin',
            'email'=>'admin@admin.com',
            'phone'=>'055484885541',
            'address'=>'Gaza',
            'status'=>1,
            'image'=>'default.png',
            'roles_name' => ["owner"],
            'password'=>bcrypt('admin123456'),
        ]);



        $role = Role::create(['guard_name' => 'admin','name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
