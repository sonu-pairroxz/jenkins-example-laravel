<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['id'=>Str::uuid(), 'name' => 'add user']);
        Permission::create(['id'=>Str::uuid(), 'name' => 'edit user']);
        Permission::create(['id'=>Str::uuid(), 'name' => 'delete user']);
        Permission::create(['id'=>Str::uuid(), 'name' => 'add comment']);
        Permission::create(['id'=>Str::uuid(), 'name' => 'edit comment']);
        Permission::create(['id'=>Str::uuid(), 'name' => 'add query']);

        //Roles create
        Role::create(['id'=>Str::uuid(), 'name'=> 'admin'])->givePermissionTo(['add user','edit user','delete user','add query','edit comment']);
        Role::create(['id'=>Str::uuid(), 'name'=> 'super-admin'])->givePermissionTo(Permission::all());

    }
}
