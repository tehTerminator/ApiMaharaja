<?php

namespace App\Http\Controllers;

use App\Services\RolesService;
use App\Services\ValidationService;
use Illuminate\Http\Request;

class RolesController extends Controller {
    public function __construct()
    {
        //
    }

    public function store($request) {
        RolesController::validateRequest($request);
        RolesController::handleResponse(
            RolesService::store($request)
        );
    }

    private static function validateRequest(
        Request &$request,
        array $columns = [],
        bool $unique = true
    ) {
        $rules = ValidationService::getValidationRules('users', $columns, $unique);
        RolesController::validate($request, $rules);
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