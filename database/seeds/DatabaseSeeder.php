<?php

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        public function run()
        {
            $this->call([
              UsersTableSeeder::class,
              //ProductsTableSeeder::class,
              //CategoryTableSeeder::class,
            ]);
        }
    }
