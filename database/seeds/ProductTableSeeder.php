<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        $faker = Faker::create();

       foreach(range(1,25) as $i) {
           Product::create([
              'name' => $faker->word(),
              'description' => $faker->sentence(),
              'price' => $faker->randomNumber(2),
              'category_id' => $faker->numberBetween(1,15),
              'featured' => $faker->boolean(),
              'recommend' => $faker->boolean()
           ]);
       }
    }
}