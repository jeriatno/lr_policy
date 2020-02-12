<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
