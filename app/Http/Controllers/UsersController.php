<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $timestamps = false;

    public function add_user(Request $req)
    {
       
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

   
        $hashedPassword = Hash::make($req->password);

  
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $hashedPassword,
            'role_id' => $req->role_id,
        ]);

        return response()->json(['message' => 'User added successfully'], 201);
    }
}
