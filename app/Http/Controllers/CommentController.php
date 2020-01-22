<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article_id = $request -> input("article_id");
        $content = $request -> input("content");
        
        if($article_id && $content) {
            $user_id = Auth::id();

            $article = Article::find($article_id);

            if($article) {
                $article -> comments() -> create([
                    "user_id" => $user_id,
                    "content" => $content
                ]);

                return redirect(url()->previous() . "#comments")
                    ->withInput(["message" => "Comment added successfully"]);
            } else {
                return redirect() -> route("home");
            }
        } else {
            return redirect() -> route("home");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $content = $request -> input("content");

        if($content) {
            $comment = Comment::find($id);

            if($comment) {
                if(Auth::id() == $comment->user["id"]) {
                    $comment -> content = $content;
                    $comment -> save();

                    return redirect(url()->previous() . "#comments")
                        ->withInput(["message" => "Comment updated successfully"]);
                } else {
                    return redirect() -> route("home");
                }
            } else {
                return redirect() -> route("home");
            }
        } else {
            return redirect() -> route("home");
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
        $user_id = Auth::id();
        Comment::where("id", $id)->where("user_id", $user_id)->delete();
        
        return redirect(url()->previous() . "#comments")
            ->withInput(["message" => "Comment deleted successfully"]);
    }
}
