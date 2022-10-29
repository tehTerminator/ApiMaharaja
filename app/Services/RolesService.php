<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesService extends AbstractService {
    public static function store(Request $req) {
        $role = new Role();
        $role->title = $req->title;
        $role->weight = RolesService::getWeight($req->weight);
        return $role->save();
    }

    public static function update(Request $req) {
        // Not Implemented
    }

    public static function delete(Request $req) {
        // Not Implemented
    }

    public static function retrieve(Request $req) {
        // Not Implemented
    }

    private static function getWeight(int $weight) {
        $weight = Role::where('weight', $weight)->first();
        if (empty($weight)) {
            return $weight;
        }

        return Role::min('weight') - 1;
    }
}