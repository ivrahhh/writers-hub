<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'user_id',
        'status',
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

    public function chapters() : HasMany
    {
        return $this->hasMany(Chapter::class,'book_id');
    }

    public function image() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
