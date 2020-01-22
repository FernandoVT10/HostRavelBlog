<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $main_article = Article::orderBy("created_at", "desc") -> take(1) -> first();
        $recent_articles = Article::orderBy("created_at", "desc") -> skip(1) -> take(6) -> get();

        # we skip 7 articles so they aren't repeated
        $other_articles = Article::orderBy("created_at", "desc") 
                                    -> skip(7) -> take(6) -> inRandomOrder() -> get();

        return view("home", [
            "main_article" => $main_article,
            "recent_articles" => $recent_articles, 
            "other_articles" => $other_articles
        ]);
    }
}
