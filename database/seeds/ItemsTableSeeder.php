<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('items')->insert([
        'user_id' => 1,
        'category_id' => 7,
        'name' => 'Bicicleta Oxford MB25-3',
        'description' => '',
        'brand' => '',
        'new' => false,
        'status' => 0
      ]);

      DB::table('items')->insert([
        'user_id' => 1,
        'category_id' => 5,
        'name' => 'iPhone 7 256GB Black',
        'description' => '',
        'brand' => '',
        'new' => false,
        'status' => 0
      ]);

      DB::table('items')->insert([
        'user_id' => 1,
        'category_id' => 6,
        'name' => 'iPad Air 128GB',
        'description' => '',
        'brand' => '',
        'new' => false,
        'status' => 0
      ]);

      DB::table('items')->insert([
        'user_id' => 1,
        'category_id' => 10,
        'name' => 'Zapatillas Nike AirFit 42',
        'description' => '',
        'brand' => '',
        'new' => false,
        'status' => 0
      ]);
    }
}
