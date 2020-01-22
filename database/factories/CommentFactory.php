<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "user_id" => 1,
        "article_id" => 1,
        "content" => $faker -> text(200)
    ];
});
