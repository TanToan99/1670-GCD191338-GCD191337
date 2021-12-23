<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        Roles::firstOrCreate(['name' => Roles::ROLE_ADMIN]);
        Roles::firstOrCreate(['name' => Roles::ROLE_STAFF]);
        Roles::firstOrCreate(['name' => Roles::ROLE_TRAINER]);
        Roles::firstOrCreate(['name' => Roles::ROLE_TRAINEE]);
        $user = User::all()->first();
        $user->roles()->sync([1]);
    }
}
