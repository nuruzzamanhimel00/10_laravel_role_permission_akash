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
        $superAdmin = Role::create(['name' => 'superadmin','guard_name'=>'admin']);
        $admin = Role::create(['name' => 'admin','guard_name'=>'admin']);
        $editor = Role::create(['name' => 'editor','guard_name'=>'admin']);
        $user = Role::create(['name' => 'user','guard_name'=>'admin']);

        //permission array

        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    'blog.view',
                    'blog.edit',
                    'blog.update',
                    'blog.delete',
                    'blog.approve',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.view',
                    'admin.edit',
                    'admin.update',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.view',
                    'role.edit',
                    'role.update',
                    'role.delete',
                    'role.approve',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    'profile.view',
                    'profile.edit'
                ]
            ],
        ];

        //only permission create
        // $permission = Permission::create(['name' => 'edit articles']);

          //permission create with role
        foreach($permissions as $permission){

            foreach($permission['permissions'] as $pr){
                $permissionCreate = Permission::create(['name' => $pr,'group_name'=>$permission['group_name'],'guard_name'=>'admin']);
                $superAdmin->givePermissionTo($permissionCreate);
            }

        }


    }
}
