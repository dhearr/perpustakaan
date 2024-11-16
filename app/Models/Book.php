<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'writer', 'publisher', 'publication_year', 'status'];

    public function borrowing(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
