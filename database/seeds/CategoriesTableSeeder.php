<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Electrónica category
        DB::table('categories')->insert([
          'name' => 'Electrónica',
          'description' => '',
          'parent' => 0
        ]);

        //Transporte category
        DB::table('categories')->insert([
          'name' => 'Transporte',
          'description' => '',
          'parent' => 0
        ]);

        //Deporte category
        DB::table('categories')->insert([
          'name' => 'Deporte',
          'description' => '',
          'parent' => 0
        ]);



        //Electronica sub-categories
        DB::table('categories')->insert([
          'name' => 'Computadores y Laptops',
          'description' => '',
          'parent' => 1
        ]);

        DB::table('categories')->insert([
          'name' => 'Celulares',
          'description' => '',
          'parent' => 1
        ]);

        DB::table('categories')->insert([
          'name' => 'Tablets',
          'description' => '',
          'parent' => 1
        ]);


        //Transporte sub-categories
        DB::table('categories')->insert([
          'name' => 'Bicicletas',
          'description' => '',
          'parent' => 2
        ]);

        DB::table('categories')->insert([
          'name' => 'Motocicletas',
          'description' => '',
          'parent' => 2
        ]);

        DB::table('categories')->insert([
          'name' => 'Otros',
          'description' => '',
          'parent' => 2
        ]);


        //Deporte sub-categories
        DB::table('categories')->insert([
          'name' => 'Ropa y Calzado',
          'description' => '',
          'parent' => 3
        ]);

        DB::table('categories')->insert([
          'name' => 'Suplementos',
          'description' => '',
          'parent' => 3
        ]);

        DB::table('categories')->insert([
          'name' => 'Accesorios',
          'description' => '',
          'parent' => 3
        ]);



    }
}
