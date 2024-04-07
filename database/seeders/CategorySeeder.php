<?php

namespace Database\Seeders;

use App\Enums\CategoryStatusEnum;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        PostCategory::create([
            'name' => 'Uncategorized',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        PostCategory::create([
            'name' => 'New',
            'status' => CategoryStatusEnum::PUBLISHED->value,
        ]);
        PostCategory::create([
            'name' => 'Unpublished',
            'status' => CategoryStatusEnum::UNPUBLISHED->value,
        ]);
    }
}
