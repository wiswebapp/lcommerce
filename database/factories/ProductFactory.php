<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return factory(Category::class)->create()->id;
        },
        'subcategory_id' => function() {
            return factory(Category::class)->create()->id;
        },
        'product_name' => $faker->name,
        'product_description' => $faker->sentence,
        'price' => rand(100,999),
        'product_image' => 'no-product.jpg',
    ];
});
