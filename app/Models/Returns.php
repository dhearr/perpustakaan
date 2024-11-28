<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Returns extends Model
{
    use HasFactory;

    protected $table = 'returns';
    protected $fillable = ['borrowing_id', 'date_return', 'charge'];
    protected $with = ['borrowing.book', 'borrowing.member'];

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class, 'borrowing_id');
    }

    protected static function booted()
    {
        static::created(function ($return) {
            $borrowing = $return->borrowing;

            // Update status peminjaman
            if ($borrowing) {
                $borrowing->update(['status' => 'dikembalikan']);
            }

            // Update status buku
            if ($borrowing && $borrowing->book) {
                $borrowing->book->update(['status' => 'tersedia']);
            }
        });

        static::creating(function (Returns $return) {
            $borrowing = Borrowing::find($return->borrowing_id);

            if ($borrowing) {
                $dateDue = Carbon::parse($borrowing->date_due)->startOfDay();
                $dateReturn = Carbon::parse($return->date_return ?? now())->startOfDay();
                $charge = 0;

                if ($dateReturn->greaterThan($dateDue)) {
                    $lateDays = $dateDue->diffInDays($dateReturn);
                    $charge = $lateDays * 1000;
                }

                $return->charge = $charge;
            }
        });

        static::saved(function () {
            Cache::forget('returns_badge_count');
        });

        static::deleted(function () {
            Cache::forget('returns_badge_count');
        });
    }

}
