<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['code', 'name', 'description', 'archive'];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_teacher']);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_teacher'])
            ->wherePivot('is_teacher', true);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_teacher'])
            ->wherePivot('is_teacher', false);
    }

    public function scopeArchive($query, $type)
    {
        return $query->whereArchive($type);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)
            ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'on_classroom');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'on_classroom');
    }
}
