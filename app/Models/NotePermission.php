<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotePermission extends Model
{
    protected $table = 'note_permissions';

    protected $fillable = [
        'note_id',
        'shared_with_user_id',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
