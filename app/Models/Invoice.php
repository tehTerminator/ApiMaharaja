<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 
        'ledger_id', 
        'paid', 
        'amount', 
        'user_id'
    ];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function briefTransactions() {
        return $this->hasMany(BriefTransaction::class);
    }

    public function detailedTransactions() {
        return $this->hasMany(DetailedTransaction::class);
    }
    
    public function ledger() {
        return $this->hasOne(Ledger::class);
    }
}
