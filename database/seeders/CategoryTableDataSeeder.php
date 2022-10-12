<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        
        $objects = [
            ['id' => 1, 'title' => 'Freestyle'],
            ['id' => 2, 'title' => 'Hiburan'],
            ['id' => 3, 'title' => 'Food'],
            ['id' => 4, 'title' => 'Otomotif'],
            ['id' => 5, 'title' => 'Perkantoran']
        ];
        
        foreach ($objects as $row) {
            Category::create($row);
        }
    }
}
