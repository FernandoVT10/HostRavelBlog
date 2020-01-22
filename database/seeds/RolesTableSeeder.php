<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name" => "SuperAdmin"]);

        $writerPermissionsName = ["edit_article", "create_article", "delete_article"];
        $writerPermissions = Permission::whereIn('name', $writerPermissionsName) -> get();
        $roleWriter = Role::create(["name" => "writer"]);
        $roleWriter -> givePermissionTo($writerPermissions);
    }
}
