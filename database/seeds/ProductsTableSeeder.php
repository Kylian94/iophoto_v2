<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => "T-shirt Homme",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 50,
                'price' => 19.99,
                'image' => 'https://image.made-in-china.com/43f34j10AvEtBKCGnJpz/Wholesale-100-Cotton-Man-Blank.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "T-shirt Femme",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 50,
                'price' => 19.99,
                'image' => 'https://www.tenuecomplete.com/35471-large_default/t-shirt-sans-etiquette-sans-marque-femme-col-v-coton.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Coussin",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 30,
                'price' => 29.99,
                'image' => 'https://www.mon-totebag.com/442-large_default/coussin-vierge.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => 'Coque Iphone',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 400,
                'price' => 9.99,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/216Mbbp16YL.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
        ];

        DB::table('products')->insert($products);
    }
}
