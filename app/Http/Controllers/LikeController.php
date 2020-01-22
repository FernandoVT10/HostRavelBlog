<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $commentId)
    {
        $comment = Comment::find($commentId);

        if($comment) {
            $user_id = Auth::id();

            $like = $comment -> likes() -> where("user_id", $user_id) -> first();

            if($like) {
                $like -> delete();
                return redirect(url()->previous() . "#comments")
                    ->withInput(["message" => "Like removed successfully"]);
            } else {
                $comment -> likes() -> create([
                    "user_id" => $user_id
                ]);

                return redirect(url()->previous() . "#comments")
                    ->withInput(["message" => "Like added successfully"]);
            }
        } else {
            return redirect() -> route("home");
        }
    }
}
