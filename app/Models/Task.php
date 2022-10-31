<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $fillable = [
        'title',
        'customer_id',
        'created_by',
    ];

    public function customer() {
        $this->belongsTo(Customer::class);
    }
}