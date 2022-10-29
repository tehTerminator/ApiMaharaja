<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ValidationService;
use Illuminate\Auth\Events\Validated;
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
        $this->validateRequest($request, ['email', 'password'], false);
        $user = UserService::authenticate(
            $request->email,
            $request->password
        );
        $this->handleResponse(true, $user);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $this->handleResponse(UserService::store($request));
    }

    public function updatePassword(Request $request)
    {
        $this->handleResponse(
            UserService::updatePassword(
                $request->oldPassword,
                $request->newPassword
            )
        );
    }

    private function validateRequest(
        Request &$request,
        array $columns = [],
        bool $unique = true
    ) {
        $rules = ValidationService::getValidationRules('users', $columns, $unique);
        $this->validate($request, $rules);
    }

    private function handleResponse($status, $data = NULL)
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
