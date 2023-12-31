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
        'name',
        'email',
        'nickname',
        'password',
        'photo_path',
         'about'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
/*     protected $hidden = [
        'password',
        'remember_token',
    ]; */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function follows() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function likes() {
        return $this->belongsToMany(Photo::class, 'likes');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
