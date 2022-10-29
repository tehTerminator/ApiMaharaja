<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function __contruct() {}

    public static function authenticate(string $username, string $password) 
    {
        $user = User::with('role')
        ->where('username', $username)
        ->first();
        
        if( !empty($user) )
        {
            if( Hash::check($password, $user->password))
            {
                $user->token = UserService::generate_token();
                $user->save();
                $user->refresh();
                return $user;
            }
        }
        return response('Unauthorised', 401);
    }

    public static function store(Request $request) {
        $user = new User();
        $user->title = $request->input('title');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        return $user->save();
    }

    public static function updatePassword(string $oldPassword, $newPassword) {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if (Hash::check($oldPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            return $user->save();
        }
        return false;
    }

    private static function generate_token() {
        return bin2hex(random_bytes(16));
    }
}