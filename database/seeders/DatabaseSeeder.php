<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>'123'
        ]);


        \App\Models\Category::factory()->create([
            'title'=>'test',
        ]);

        \App\Models\Category::factory()->create([
            'title' => 'foo'
        ]);

        \App\Models\Tag::factory()->create([
            'title' => 'tag_1'
        ]);

        \App\Models\Tag::factory()->create([
            'title' => 'tag_2'
        ]);

    }
}
