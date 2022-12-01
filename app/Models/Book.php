<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillble = [
        'title',
        'synopsis',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function genres() : BelongsToMany
    {
        return $this->belongsToMany(Genre::class,'book_genres','book_id','genre_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'book_tags','book_id','tag_id');
    }
}
