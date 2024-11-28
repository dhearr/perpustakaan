<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $dates = ['date_loan', 'date_due'];

    protected $fillable = ['book_id', 'member_id', 'date_loan', 'date_due', 'status'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function returns(): HasOne
    {
        return $this->hasOne(Returns::class, 'borrowing_id');
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('borrowed_badge_count');
        });

        static::created(function ($borrowing) {
            $borrowing->book->update(['status' => 'dipinjam']);
        });

        static::updated(function ($borrowing) {
            if ($borrowing->isDirty('status')) {
                if ($borrowing->status === 'dipinjam') {
                    $borrowing->book->update(['status' => 'dipinjam']);
                } elseif ($borrowing->status === 'dikembalikan') {
                    $borrowing->book->update(['status' => 'tersedia']);
                }
            }
        });

        static::deleted(function ($borrowing) {
            if ($borrowing->status === 'dikembalikan') {
                $borrowing->book->update(['status' => 'tersedia']);
            }
            Cache::forget('borrowed_badge_count');
        });
    }

}
