<?php

use App\Article;
use Illuminate\Database\Seeder;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 21; $i++) { 
            factory(App\Article::class) -> create([
                "thumb" => "article-$i.jpg",
            ]);
        }
    }
}
