<?php

namespace Database\Seeders;

use App\Models\Merchant_currency;
use Illuminate\Database\Seeder;

class MerchantCurrencyTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant_currency::truncate();
        
        $objects = [
            ['id' => 1, 'merchant_id' => '1', 'currency_id' => '1'],            
            ['id' => 2, 'merchant_id' => '2', 'currency_id' => '1']
        ];
        
        foreach ($objects as $row) {
            Merchant_currency::create($row);
        }
    }
}
