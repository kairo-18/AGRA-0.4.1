<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::factory()->create([
           'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
        ]);
        $user2 = User::factory()->create([
            'name' => 'test2',
            'email' => 'test2@example.com',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'teacher']);
        $user->assignRole($role);
        $user2->assignRole($role2);
    }
}
