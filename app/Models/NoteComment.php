<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    protected $table = 'note_comments';
    protected $fillable = ['user_id', 'note_id', 'comment', 'comment_parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function replies()
    {
        return $this->hasMany(NoteComment::class, 'comment_parent_id');
    }

    public function getCommentAttribute($value)
    {
        return strip_tags($value);
    }
}
