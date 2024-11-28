<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'writer', 'publisher', 'publication_year', 'status'];
    protected $attributes = ['status' => 'tersedia',];

    protected static function booted()
    {
        static::saving(function ($book) {
            $book->title = str::title($book->title);
            $book->writer = str::title($book->writer);
        });
    }

    public function borrowing(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function rack(): BelongsTo
    {
        return $this->belongsto(Rack::class, 'rack_id');
    }
}
