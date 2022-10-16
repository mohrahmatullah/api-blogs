<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::truncate();
        
        $objects = [
            ['id' => 1, 'name' => 'Rupiah', 'abbreviation' => 'RP'],            
            ['id' => 2, 'name' => 'Dollar', 'abbreviation' => 'USD']
        ];
        
        foreach ($objects as $row) {
            Currency::create($row);
        }
    }
}
