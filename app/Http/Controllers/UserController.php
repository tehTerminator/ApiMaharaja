<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ValidationService;
use Illuminate\Http\Request;

class UserController extends Controller
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

    public static function authenticate(Request $request)
    {
        UserController::validateRequest($request, ['email', 'password'], false);
        $user = UserService::authenticate(
            $request->email,
            $request->password
        );
        UserController::handleResponse(true, $user);
    }

    public static function store(Request $request)
    {
        UserController::validateRequest($request);
        UserController::handleResponse(UserService::store($request));
    }

    public static function updatePassword(Request $request)
    {
        UserController::handleResponse(
            UserService::updatePassword(
                $request->oldPassword,
                $request->newPassword
            )
        );
    }

    private static function validateRequest(
        Request &$request,
        array $columns = [],
        bool $unique = true
    ) {
        $rules = ValidationService::getValidationRules('users', $columns, $unique);
        UserController::validate($request, $rules);
    }

    private static function handleResponse($status, $data = NULL)
    {
        if (!$status) {
            return response('Failed to Save Data', 400);
        }

        if (is_null($data)) {
            return response('Success');
        }

        return response('Success')->json($data);
    }
}
