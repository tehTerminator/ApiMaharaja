<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class AbstractService {
    public static abstract function store(Request $request);
    public static abstract function update(Request $request);
    public static abstract function delete(Request $request);
    public static abstract function retrieve(Request $request);
}
