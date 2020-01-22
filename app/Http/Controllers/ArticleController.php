<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this -> middleware(['permission:create_article|edit_article|delete_article'])
                    -> except(["index", "show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request -> input("search")) {
            $search = $request -> input("search");
            $articles = Article::where("title", "Like", "%{$search}%") -> paginate(12);
            $articles -> withPath("/articles?search=$search");
        } else {
            $articles = Article::orderBy("created_at", "desc") -> paginate(12);
        }
        return view("articles.index", ["articles" => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            "title" => ["required", "max:100"],
            "description" => ["required", "max:500"],
            "thumb" => ["required", "image", "mimes:jpeg,png,jpg", "max:5000"],
            "content" => ["required"],
        ]);

        $thumb = $request -> file("thumb");
        $thumb_name = time() . $thumb -> getClientOriginalName();

        $thumb -> storeAs("img/articles/", $thumb_name);

        Article::create([
            "title" => $request -> input("title"),
            "description" => $request -> input("description"),
            "thumb" => $thumb_name,
            "content" => $request -> input("content"),
        ]);

        return redirect("/articles/")
                -> withInput(["message" => "Article added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        
        if($article) {
            $comments = $article -> comments() -> orderBy("created_at", "desc") -> get();
            $current_user = [];
            $current_user_id = Auth::id();

            if(Auth::check()) {
                $current_user["avatar"] = Auth::user()["avatar"];
            }

            foreach($comments as $key => $comment) {
                if($comment -> user["id"] == $current_user_id) {
                    $comments[$key]["user_comment"] = true;
                }

                $user_likes = $comment -> likes -> where("user_id", $current_user_id);

                if($user_likes -> count() > 0) {
                    $comments[$key]["user_likes"] = true;
                }
            }

            return view("articles.show", [
                "article" => $article,
                "comments" => $comments,
                "current_user" => $current_user]);
        } else {
            return abort(403, "The article doesn't exists");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        if($article) {
            return view("articles.edit", ["article" => $article]);
        } else {
            return abort(403, "The article doesn't exists");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request -> hasFile("thumb")) {
            $request -> validate([
                "title" => ["required", "max:100"],
                "description" => ["required", "max:500"],
                "thumb" => ["required", "image", "mimes:jpeg,png,jpg", "max:5000"],
                "content" => ["required"],
            ]);
    
            $article = Article::find($id);
    
            if($article) {
                $thumb = $request -> file("thumb");
                $thumb -> storeAs("img/articles/", $article["thumb"]);
    
                $article -> title = $request -> input("title");
                $article -> description = $request -> input("description");
                $article -> content = $request -> input("content");
                $article -> save();
    
                return redirect("/articles/")
                    -> withInput(["message" => "Article updated successfully"]);
            } else {
                return abort(403, "The article doesn't exists");
            }
        } else {
            $request -> validate([
                "title" => ["required", "max:100"],
                "description" => ["required", "max:500"],
                "content" => ["required"],
            ]);
    
            $article = Article::find($id);
    
            if($article) {
                $article -> title = $request -> input("title");
                $article -> description = $request -> input("description");
                $article -> content = $request -> input("content");
                $article -> save();
    
                return redirect("/articles/")
                    -> withInput(["message" => "Article updated successfully"]);
            } else {
                return abort(403, "The article doesn't exists");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $article = Article::find($id);

        if($article) {
            unlink(public_path()."/img/articles/".$article["thumb"]);
            $article -> delete();

            return redirect("/articles/")
                    -> withInput(["message" => "Article deleted successfully"]);
        } else {
            return abort(403, "The article doesn't exists");
        }
    }

    /**
     * Add an image for the content of an article
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        if($request -> hasFile("image")) {
            $image = $request -> file("image");

            if($image -> getSize() <= 10000000) {
                $image_name = md5_file($image).".png";

                $image_url = $image -> storeAs("img/articles/content", $image_name);
                return array("status" => true, "image_url" => asset($image_url));
            } else {
                return array(
                    "status" => false,
                    "message" => "The image must weigh less than 10 MB"
                );
            }
        } else {
            return array("status" => false);
        }
    }
}
