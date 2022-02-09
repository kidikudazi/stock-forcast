<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = (Object) [
            [
                "stock" => "Yam",
                "current_price" => 5000,
                "unit" => "5kg"
            ],
            [
                "stock" => "Rice",
                "current_price" => 35000,
                "unit" => "15kg"
            ],
            [
                "stock" => "Beans",
                "current_price" => 55000,
                "unit" => "35kg"
            ],
            [
                "stock" => "Plantain",
                "current_price" => 7500,
                "unit" => "8kg"
            ],
            [
                "stock" => "Potatoes",
                "current_price" => 9000,
                "unit" => "5kg"
            ],
        ];

        foreach ($stocks as $stock) {
            Stock::updateOrCreate(
                [
                    'name'  => $stock['stock'],
                ],
                [
                    'name' => $stock['stock'],
                    'current_price' => $stock['current_price'],
                    'unit' => $stock['unit'],
                ]
            );
        }
    }
}
