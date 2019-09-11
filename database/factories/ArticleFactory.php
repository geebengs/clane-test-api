<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Clane\models\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    $title =  $faker->sentence;
    
    return [
        'title' => $title,
        'slug' => Str::slug($title, "-"),
        'content' => $faker->paragraph,
        'user_id' => 1,
        'published' => 1
    ];
});
