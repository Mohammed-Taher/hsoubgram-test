<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable = ['image', 'description', 'slug', 'user_id'];

    public $casts = [
        'private' => 'boolean'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function liked(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }


}
