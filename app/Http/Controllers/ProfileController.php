<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfile()
    {
        return view("profile.edit_profile", ["user" => Auth::user()]);
    }

    public function changeAvatar()
    {
        return view("profile.change_avatar", ["user" => Auth::user()]);
    }

    public function changePassword()
    {
        return view("profile.change_password");
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $email = $request -> input("email");
        $user = User::find(Auth::id());

        # we check if the email has changed
        if($user["email"] == $email) {
            # if it hasn't changed, i just updated the name
            $request -> validate([
                'name' => ["required", "max:255"]
            ]);

            $name = $request -> input("name");
            $user -> name = $name;
            $user -> save();

            return redirect() -> back()
                    -> withInput(["message" => "Profile updated successfully"]);
        } else {
            # if it changes, we check if the email already exists

            $request -> validate([
                'name' => ["required", "max:255"],
                'email' => ["required", "unique:users", "max:255"]
            ]);

            # and we update the user
            $name = $request -> input("name");
            $user -> name = $name;
            $user -> email = $email;
            $user -> save();

            return redirect() -> back()
                    -> withInput(["message" => "Profile updated successfully"]);
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        if($request -> hasFile("avatar")) {
            $file = $request -> file("avatar");
            $file_name = Auth::id().".png";

            $file -> storeAs("img/avatars/", $file_name);

            $user = User::find(Auth::id());
            $user -> avatar = $file_name;
            $user -> save();

            return redirect() -> back()
                    -> withInput(["message" => "Avatar updated successfully"]);
        } else {
            return abort(404);
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request -> validate([
            "new_password" => ["required", "min:6", "same:repeat_new_password"],
            "current_password" => ["required", new MatchOldPassword]
        ]);

        $new_password = $request -> input("new_password");

        User::find(Auth::id()) -> update(["password" => Hash::make($new_password)]);

        return redirect() -> back()
                -> withInput(["message" => "Password updated successfully"]);
    }
}
