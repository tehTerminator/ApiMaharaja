<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $fillable = [
        'title',
        'customer_id',
        'created_by',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function acceptedBy() {
        return $this->belongsTo(User::class, 'accepted_by', 'id');
    }

    public function scopePending($query) {
        return $query->where('state', 'PENDING');
    }

    public function scopeRejected($query) {
        return $query->where('state', 'REJECTED');
    }

    public function scopeAccepted($query) {
        return $query->where('state', 'ACCEPTED');
    }

    public function scopeCompleted($query) {
        return $query->where('state', 'COMPLETED');
    }

    public function scopeToday($query) {
        return $query->whereDate('created_at', Carbon::today());
    }
}