<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailedTransaction extends Model {
    protected $table = 'detailed_transactions';

    protected $fillable = [
        'invoice_id',
        'item_id',
        'user_id',
        'item_type',
        'description',
        'quantity',
        'rate',
        'discount',
    ];
}