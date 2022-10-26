<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {
    protected $fillable = [
        'user_id',
        'title',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'does_expire' => false,
        'has_count' => false,
        'expiry_date' => NULL
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'expire_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'does_expire' => 'boolean',
        'has_count' => 'boolean',
        'count' => 'integer'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }    
}