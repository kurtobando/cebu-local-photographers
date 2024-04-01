<?php

namespace Database\Seeders;

use App\Enums\CategoryStatusEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Category 101',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        Category::create([
            'name' => 'Category 102',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        Category::create([
            'name' => 'Category 103',
            'status' => CategoryStatusEnum::UNPUBLISHED->value,
        ]);
    }
}
