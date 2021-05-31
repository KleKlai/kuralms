<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;

    protected $fillable = ['user_id', 'body', 'type', 'date', 'time'];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'on_post');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'on_post');
    }

}
