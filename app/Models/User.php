<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'user_comment', 'user_id', 'comment_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function libraries()
    {
        return $this->hasMany(Library::class, 'user_id', 'id');
    }

    public function accesses()
    {
        return $this->hasMany(LibraryUserAccesses::class, 'user_id_owner');
    }

    public function hasLibraryAccess($profileId)
    {
        return $this->accesses->contains('user_id_shared', $profileId);
    }

    public function sharedToUser()
    {
        return $this->belongsTo(User::class, 'user_id_shared');
    }
}
