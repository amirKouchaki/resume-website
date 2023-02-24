<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => config('admin.name'),
             'email' => config('admin.email'),
             'phone' => config('admin.phone'),
             'password' => bcrypt(config('admin.password')),
             'is_admin' => true
         ]);
    }
}
