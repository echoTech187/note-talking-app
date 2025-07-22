<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function permissions()
    {
        return $this->hasMany(NotePermission::class);
    }

    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }

    public function userInitial()
    {
        if (empty($this->name)) {
            return '';
        }
        $fullname = explode(' ', $this->name);
        $firstName = $fullname[0];
        $lastName = $fullname[1] ?? '';

        return mb_substr($firstName, 0, 1) . mb_substr($lastName, 0, 1);
    }
}
