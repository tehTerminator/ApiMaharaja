<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MainController extends Controller
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

    public function store(Request $request, string $table) {
        switch ($table) {
            case 'users':
                UserController::store($request);
                break;
            default:
                return response('Bad Request', 400);
        }
    }

    //
}
