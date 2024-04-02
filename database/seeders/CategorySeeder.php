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
            'name' => 'Uncategorized',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        Category::create([
            'name' => 'New',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        Category::create([
            'name' => 'Unpublished',
            'status' => CategoryStatusEnum::UNPUBLISHED->value,
        ]);
    }
}
