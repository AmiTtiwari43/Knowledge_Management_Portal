<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'color' => '#3b82f6'],
            ['name' => 'Design', 'color' => '#ec4899'],
            ['name' => 'Marketing', 'color' => '#10b981'],
            ['name' => 'Data Science', 'color' => '#8b5cf6'],
            ['name' => 'Business', 'color' => '#f59e0b'],
            ['name' => 'IT & Software', 'color' => '#6366f1'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
