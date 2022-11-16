<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(Request $request) {
        $users = User::all();
        //dd($users[0]->name); //dump and die
        return view('users', ['users' => $users]);
    }

    public function saveUser(Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->projectId = $request->projectId;
        $user->teamId = $request->teamId;
        $user->save();
        return redirect('admin')->with('status', 'New Employee Has Been inserted');
    }

}