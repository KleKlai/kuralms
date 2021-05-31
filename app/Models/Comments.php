<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'on_post', 'from_user', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    // returns post of any comment
    public function post()
    {
        return $this->belongsTo(Post::class, 'on_post');
    }
}
