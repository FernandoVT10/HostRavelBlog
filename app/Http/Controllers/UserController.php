<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this -> middleware(['permission:create_user|edit_user|delete_user']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request -> has("search")) {
            $search = $request -> input("search");
            
            if((int) $search > 0) {
                $users = User::where("id", $search) -> paginate(1);
            } else {
                $users = User::where("id", "!=", Auth::id())
                        -> where("name", "Like", "%{$search}%") 
                        -> paginate(20);
            }

            $users -> withPath("manage/users?search=$search");
        } else {

            $users = User::where("id", "!=", Auth::id())
                    -> orderBy("updated_at", "desc")
                    -> paginate(20);
        }
        return view("users.index", ["users" => $users]);
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
        //
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
        $user = User::find($id);

        if($user -> roles -> first()) {
            $role = $user -> roles -> first() -> name;
        } else {
            $role = "none";
        }

        if($user) {
            $roles = Role::all();
            return view("users.edit", [
                "user" => $user,
                "roles" => $roles,
                "user_role" => $role
            ]);
        } else {
            return abort(403, "The user doesn't exists");
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
        $email = $request -> input("email");
        $user = User::find($id);

        if($user["email"] == $email) {
            $request -> validate([
                'name' => ["required", "max:255"],
                'role' => ['required']
            ]);

            $name = $request -> input("name");
            $role = $request -> input("role");

            $user -> roles() -> detach();

            if(Role::where("name", $role) -> count()) {
                $user -> assignRole($role);
            }

            $user -> name = $name;
            $user -> save();

            return redirect("/users/");
        } else {
            $request -> validate([
                'name' => ["required", "max:255"],
                'email' => ["required", "unique:users", "max:255"],
                'role' => ['required']
            ]);

            $name = $request -> input("name");
            $role = $request -> input("role");

            $user -> roles() -> detach();

            if(Role::where("name", $role) -> count()) {
                $user -> assignRole($role);
            }

            $user -> name = $name;
            $user -> email = $email;
            $user -> save();

            return redirect("/users/");
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
        $user = User::find($id);

        if($user) {
            $user -> delete();
            return redirect("/users/");
        } else {
            return abort(403, "The user doesn't exists");
        }
    }
}
