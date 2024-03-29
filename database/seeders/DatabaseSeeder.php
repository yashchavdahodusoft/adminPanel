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

        \App\Models\Admin::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
        ]);

        \App\Models\Category::factory(15)->create()->each(function($category){
            \App\Models\SubCategory::factory(10)->create(['category_id'=>$category])->each(function($sub_category) use ($category){
                $numbers = random_int(3,5);
                \App\Models\Post::factory($numbers)->create(['category_id'=>$category,'sub_category_id'=>$sub_category]);
            });
        });
    }
}
