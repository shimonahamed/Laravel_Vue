<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleModule;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Module::truncate();
        RolePermission::truncate();
        RoleModule::truncate();
        Permission::truncate();

        $modules = [
            [

                'name' => 'Product',
                'key' => 'product',
                'link' => '#',
                'permission' => ['add', 'view', 'edit', 'delete'],
                'submeuns' => [
                    ['name' => 'Category',
                        'key' => 'category',
                        'link' => '/admin/product/category',
                        'permission' => ['add', 'view', 'edit', 'delete'],
                        'submeuns' => []
                    ],
                    ['name' => 'SubCategory', 'key' => 'sub_category', 'link' => '/admin/product/sub_category', 'permission' => ['add', 'view', 'edit', 'delete'],],
                    ['name' => 'Product', 'key' => 'product', 'link' => '/admin/product/product', 'permission' => ['add', 'view', 'edit', 'delete'],]
                    ],
            ],
            [
                'name' => 'Post',
                'key' => 'Post',
                'link' => '#',
                'permission' => ['add', 'view', 'edit', 'delete'],
                'submeuns'=>[

                    ['name' => 'News', 'key' => 'news', 'link' => '/admin/Post/News', 'permission' => ['add', 'view', 'edit', 'delete'],],
                    ['name' => 'Opinions', 'key' => 'opinions', 'link' => '/admin/Post/Opinions', 'permission' => ['add', 'view', 'edit', 'delete'],],
                    ['name' => 'Reviews', 'key' => 'reviews', 'link' => '/admin/Post/Reviews', 'permission' => ['add', 'view', 'edit', 'delete'],],

                ]

            ]

        ];
        $Usermodules = [

            [
                'name' => 'Post',
                'key' => 'Post',
                'link' => '#',
                'permission' => ['add', 'view', 'edit', 'delete'],
                'submeuns'=>[

                    ['name' => 'News','key' => 'news', 'link' => '/admin/Post/News', 'permission' => ['add', 'view', 'edit', 'delete'],],
                    ['name' => 'Opinions', 'key' => 'opinions', 'link' => '/admin/Post/Opinions', 'permission' => ['add', 'view', 'edit', 'delete'],],
                    ['name' => 'Reviews', 'key' => 'reviews', 'link' => '/admin/Post/Reviews', 'permission' => ['add', 'view', 'edit', 'delete'],],

                ]

            ]

        ];

//        $role = new Role();
//        $role->name = 'Admin';
//        $role->save();
//
//        User::where('id', 1)->update([
//            'role_id' => 1
//        ]);
//
//        foreach ($modules as $eachModule) {
//            $module = new Module();
//            $module->name = $eachModule['name'];
//            $module->link = $eachModule['link'];
//            $module->save();
//
//            $roleModule = new RoleModule();
//            $roleModule->role_id = $role->id;
//            $roleModule->module_id = $module->id;
//            $roleModule->save();
//
//            foreach ($eachModule['permission'] as $permission) {
//                $permissionModel = new Permission();
//                $permissionModel->module_id = $module->id;
//                $permissionModel->name = $eachModule['key'] . "_" . $permission;
//                $permissionModel->save();
//
//                $rolePermission = new RolePermission();
//                $rolePermission->role_id = $role->id;
//                $rolePermission->permission_id = $permissionModel->id;
//                $rolePermission->save();
//
//            }
//            foreach ($eachModule['submeuns'] as $submeun) {
//                $subModule = new Module();
//                $subModule->parent_id = $module->id;
//                $subModule->name = $submeun['name'];
//                $subModule->link = $submeun['link'];
//                $subModule->save();
//
//                $roleModule = new RoleModule();
//                $roleModule->role_id = $role->id;
//                $roleModule->module_id = $subModule->id;
//                $roleModule->save();
//
//                foreach ($submeun['permission'] as $permission) {
//                    $subPermissionModel = new Permission();
//                    $subPermissionModel->module_id = $module->id;
//                    $subPermissionModel->name = $submeun['key'] . "_" . $permission;
//                    $subPermissionModel->save();
//
//                    $rolePermission = new RolePermission();
//                    $rolePermission->role_id = $role->id;
//                    $rolePermission->permission_id = $subPermissionModel->id;
//                    $rolePermission->save();
//
//                }
//            }
//        }




        $adminRole = Role::create(['name' => 'Admin']);
        $superadminRole = Role::create(['name' => 'Superadmin']);
        $userRole = Role::create(['name' => 'User']);


        User::where('id', 3)->update(['role_id' => $userRole->id]);
        User::where('id', 1)->update(['role_id' => $adminRole->id]);
        User::where('id', 2)->update(['role_id' => $superadminRole->id]);

        foreach ($Usermodules as $eachModule) {
            $this->userRoleWithPermissions($eachModule, $userRole);

        }
        foreach ($modules as $eachModule) {
            $this->RoleWithPermissions($eachModule, $superadminRole);
            $this->RoleWithPermissions($eachModule, $adminRole);

        }
    }


    private function userRoleWithPermissions(array $moduleData, Role $role,  $parentId=0)
    {
        $module = Module::create([
            'name' => $moduleData['name'],
            'link' => $moduleData['link'],
            'parent_id' => $parentId
        ]);

        RoleModule::create([
            'role_id' => $role->id,
            'module_id' => $module->id,
        ]);

        foreach ($moduleData['permission'] as $permission) {
            $permissionModel = Permission::create([
                'module_id' => $module->id,
                'name' => $moduleData['key'] . "_" . $permission,
            ]);

            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permissionModel->id,
            ]);
        }

        if (isset($moduleData['submeuns']) && is_array($moduleData['submeuns'])) {
            foreach ($moduleData['submeuns'] as $subModuleData) {
                $this->RoleWithPermissions($subModuleData, $role, $module->id);
            }
        }

    }
    private function RoleWithPermissions(array $moduleData, Role $role,  $parentId=0)
    {
        $module = Module::create([
            'name' => $moduleData['name'],
            'link' => $moduleData['link'],
            'parent_id' => $parentId
        ]);

        RoleModule::create([
            'role_id' => $role->id,
            'module_id' => $module->id,
        ]);

        foreach ($moduleData['permission'] as $permission) {
            $permissionModel = Permission::create([
                'module_id' => $module->id,
                'name' => $moduleData['key'] . "_" . $permission,
            ]);

            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permissionModel->id,
            ]);
        }

        if (isset($moduleData['submeuns']) && is_array($moduleData['submeuns'])) {
            foreach ($moduleData['submeuns'] as $subModuleData) {
                $this->RoleWithPermissions($subModuleData, $role, $module->id);
            }
        }

    }
}
