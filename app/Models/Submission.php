<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Submission extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'on_post', 'on_classroom', 'from_user', 'grade', 'remark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'on_post');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'on_classroom');
    }

    public function scopeActivity($query, $id)
    {
        return $query->where('on_post', $id)->where('from_user', \Auth::id());
    }
}
