<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Section;
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

        $user3 = User::factory()->create([
            'name' => 'kairo-desu',
            'email' => 'kairo@example.com',
        ]);

        $user4 = User::factory()->create([
            'name' => 'Student One',
            'email' => 'student1@example.com',
        ]);

        $category1 = Category::factory()->create([
           'name' => 'Java',
            'slug' => 'java'
        ]);

        $category2 = Category::factory()->create([
            'name' => 'C#',
            'slug' => 'csharp'
        ]);

        $section1 = Section::factory()->create([
           'SectionCode' => 'CS601'
        ]);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'teacher']);
        $role3 = Role::create(['name' => 'student']);

        $devRole = Role::create(['name' => 'dev']);

        $user->assignRole($role);
        $user2->assignRole($role2);
        $user3->assignRole($devRole);
        $user4->assignRole($role3);

    }
}
