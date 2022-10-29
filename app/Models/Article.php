<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable = [
        'title', 'body', 'category_id', 'published', 'user_id'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id')
    }
}