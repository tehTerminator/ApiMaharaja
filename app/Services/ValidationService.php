<?php

namespace App\Services;

class ValidationService
{
    private static $rules = [
        'users' => [
            'title' => ["required","string","max:255"],
            'email' => ["required","email","unique:users"],
            'password' => ["required","string","max:30"],
            'role_id' => ["required","exists:roles,id"]
        ],
        'roles' => [
            'title' => ["required","string","max:30","unique:roles"],
            'weight' => ["required","integer","max:255","unique:roles"]
        ],
        'subscriptions' => [
            'user_id' => ["required","exists:users,id"],
            'system_id' => ["unique:subscriptions","alpha_num"],
            'title' => ["required","string","max:255"],
            'does_expire' => ["boolean"],
            'has_count' => ["boolean"],
            'count' => ["integer","min:0"],
            'expire_at' => ["date","after:today"]
        ]
    ];

    /**
     * Generates Validation Rules For Table
     * @param string $table 
     * @param array $columns
     * @param bool $unique Validation Rules Contain Unique Validation Rule.
     * @return array Containing Validation Rules
     */
    public static function getValidationRules(
        string $table, 
        array $columns, 
        bool $unique=true
    ) {
        if (array_key_exists($table, ValidationService::$rules)) {
            $rules = [];
            $source = ValidationService::$rules[$table];
            foreach($columns as $col) {
                if (array_key_exists($col, $source)) {
                    $rules[$col] = $source[$col];
                    
                }
            }

            if (!$unique) {
                $rules = ValidationService::removeUniqueValidationRule($rules);
            }

            return $rules;
        }

        return [];
    }

    private static function removeUniqueValidationRule(&$arr) {
        for($i = 0; $i < count($arr); $i++) {
            if (strpos($arr[$i], 'unique') == 0) {
                unset($arr[$i]);
            }
        }

        return $arr;
    }
}
