<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ValidationService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function authenticate(Request $request)
    {
        $rules = ValidationService::getValidationRules(
            'users',
            ['email', 'password'],
            false
        );
        $this->validate($request, $rules);
        $user = UserService::authenticate(
            $request->email,
            $request->password
        );
        return response()->json($user);
    }

    public function store(Request $request)
    {
        
    }
}
