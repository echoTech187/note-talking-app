<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = ['slug', 'user_id', 'content', 'visibility'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }
    public function comments_all()
    {
        return $this->hasMany(NoteComment::class);
    }
    public function replies()
    {
        return $this->hasMany(NoteComment::class, 'comment_parent_id');
    }

    public function count_comments()
    {
        return $this->comments()->count();
    }
}
