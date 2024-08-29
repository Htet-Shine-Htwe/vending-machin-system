<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\DataClient\DataClient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $drinksFormApi =  DataClient::getDrinks();

        $toInsertData = [];
        for($i = 0; $i < 40; $i++){
            $toInsertData[] = [
                'name' => $drinksFormApi[$i]['title'],
                'slug' => Str::slug($drinksFormApi[$i]['title']),
                'price' => rand(1, 100),
                'quantity_available' => 100,
                'image' => $drinksFormApi[$i]['image'],
            ];
        }

        Product::insert($toInsertData);

    }
}
