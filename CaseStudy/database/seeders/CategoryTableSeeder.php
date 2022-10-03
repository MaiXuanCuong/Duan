<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Realme';
        $category->save();

        $category = new Category();
        $category->name = 'Apple';
        $category->save();

        $category = new Category();
        $category->name = 'Sam Sung';
        $category->save();

        $category = new Category();
        $category->name = 'Xiaomi';
        $category->save();
    }
}
