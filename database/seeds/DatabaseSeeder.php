<?php

use App\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call();

        //factory(App\Category::class,5)->create();
        //factory(Product::class,5)->create();
        //factory(App\Admin::class,1)->create();
        factory(App\User::class,5)->create();
    }
}
