<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        
        $objects = [
            ['id' => 1, 'title' => 'Freestyle'],
            ['id' => 2, 'title' => 'Hiburan'],
            ['id' => 3, 'title' => 'Food'],
            ['id' => 4, 'title' => 'Otomotif'],
            ['id' => 5, 'title' => 'Perkantoran'],
            ['id' => 6, 'title' => 'Kapal'],
            ['id' => 7, 'title' => 'Kendaraan Bermotor'],
            ['id' => 8, 'title' => 'Ruang Kios'],
            ['id' => 9, 'title' => 'Mesin dan peralatan'],
            ['id' => 10, 'title' => 'Pabrik'],
            ['id' => 11, 'title' => 'Perkebunan'],
            ['id' => 12, 'title' => 'Pesawat Terbang'],
            ['id' => 13, 'title' => 'Pusat Pembelanjaan'],
            ['id' => 14, 'title' => 'Ruko'],
            ['id' => 15, 'title' => 'Rumah Sakit'],
            ['id' => 16, 'title' => 'Tanah'],
            ['id' => 17, 'title' => 'Tanah dan Bangunan'],
            ['id' => 18, 'title' => 'Mix Used'],
            ['id' => 19, 'title' => 'Persediaan'],
        ];
        
        foreach ($objects as $row) {
            Tag::create($row);
        }
    }
}
