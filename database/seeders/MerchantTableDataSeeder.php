<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;

class MerchantTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::truncate();
        
        $objects = [
            ['id' => 1, 'name_merchant' => 'BNI', 'chanel' => 'bank_transfer'],            
            ['id' => 2, 'name_merchant' => 'BCA', 'chanel' => 'bank_transfer']
        ];
        
        foreach ($objects as $row) {
            Merchant::create($row);
        }
    }
}
