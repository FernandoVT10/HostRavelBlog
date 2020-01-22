<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name" => "create_article"]);
        Permission::create(["name" => "edit_article"]);
        Permission::create(["name" => "delete_article"]);
        Permission::create(["name" => "create_user"]);
        Permission::create(["name" => "edit_user"]);
        Permission::create(["name" => "delete_user"]);
    }
}
