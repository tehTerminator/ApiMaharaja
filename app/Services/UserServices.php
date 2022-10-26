<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function __contruct() {}

    public function authenticate(string $username, string $password) 
    {
        $user = User::with('role')
        ->where('username', $username)
        ->first();
        
        if( !empty($user) )
        {
            if( Hash::check($password, $user->password))
            {
                return $user;
            }
        }
        return response('Unauthorised', 401);
    }

    public function create(Request $request) {
        $user = new User();
        $user->title = $request->input('title');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        return $user->save();
    }

    public function updatePassword(string $oldPassword, $newPassword) {
        $user = Auth::user();

        if( Hash::check($user->password, $oldPassword) )
        {
            
        }
    }
}