<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'title', 'rate'
    ];

    protected $cast = [
        'rate' => 'double'
    ];

    public function productInfo() {
        return $this->hasMany(ProductInfo::class, 'product_id', 'id');
    }
}