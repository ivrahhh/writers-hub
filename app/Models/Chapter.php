<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'chapter_title',
        'content',
        'book_id',
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class,'book_id');
    }
}
