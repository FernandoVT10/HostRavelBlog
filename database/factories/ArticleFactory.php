<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        "title" => $faker -> realText(30),
        "description" => $faker -> realText(100),
        "content" => $faker -> realText(2000),
        "thumb" => "article_1.jpg"
    ];
});
