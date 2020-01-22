<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class) -> create([
            "name" => "SuperAdmin",
            "email" => "superadmin@gmail.com",
        ]);

        $user -> assignRole("SuperAdmin");
    }
}
