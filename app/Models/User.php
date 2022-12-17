<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'about_me',
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
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the books related to the user
     */
    public function books() : HasMany
    {
        return $this->hasMany(Book::class,'user_id');
    }

    /**
     * User image information
     */
    public function image() : MorphOne
    {
        return $this->morphOne(Image::class,'imageable');
    }

    /**
     * Check if the user is admin
     */
    public function isAdmin() : bool
    {
        return $this->role === 'Admin';
    }

    /**
     * Check if the user is author
     */
    public function isAuthor() : bool
    {
        return $this->role === 'Author';
    }

    /**
     * Check if the user is a default member
     */
    public function isMember() : bool
    {
        return $this->role === 'Member';
    }
}
