<?php

use Illuminate\Database\Seeder;
use App\Category;



class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $category = new Category;
            $category->name = "T-shirt";
            $category->save();
            
            $category2 = new Category;
            $category2->name = "Decoration";
            $category2->save();

            $category3 = new Category;
            $category3->name = "High-tech";
            $category3->save();
    }
}
