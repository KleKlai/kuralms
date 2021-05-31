<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user', 'on_classroom', 'first', 'second', 'third', 'fourth'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    // returns post of any comment
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'on_classroom');
    }
}
