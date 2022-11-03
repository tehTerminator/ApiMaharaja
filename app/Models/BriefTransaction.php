<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BriefTransaction extends Model {
    protected $table = 'brief_transactions';

    protected $fillable = [
        'title',
        'rate',
        'quantity',
        'discount',
        'invoice_id',
    ];


    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}