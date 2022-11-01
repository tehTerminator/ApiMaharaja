<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model {
    protected $fillable = [
        'product_id',
        'raw_material_id',
        'quantity'
    ];

    protected $cast = [
        'quantity' => 'double'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function raw_material() {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id', 'id');
    }
}