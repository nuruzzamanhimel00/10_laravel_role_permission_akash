<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role
        $superAdmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $user = Role::create(['name' => 'user']);

        //permission array

        $permissions = [
            'blog.view',
            'blog.edit',
            'blog.update',
            'blog.delete',
            'blog.approve',

            'admin.view',
            'admin.edit',
            'admin.update',
            'admin.delete',
            'admin.approve',

            'role.view',
            'role.edit',
            'role.update',
            'role.delete',
            'role.approve',

            'profile.view',
            'profile.edit'

        ];

        //only permission create
        // $permission = Permission::create(['name' => 'edit articles']);

          //permission create with role
        foreach($permissions as $permission){
            $permissionCreate = Permission::create(['name' => $permission]);
            $superAdmin->givePermissionTo($permissionCreate);
        }


    }
}
