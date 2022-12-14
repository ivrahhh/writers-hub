<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'genre',
        'description',
    ];

    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class,'book_genres','genre_id','book_id');
    }
}
