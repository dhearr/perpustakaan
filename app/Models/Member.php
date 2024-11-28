<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'members';
    protected $fillable = ['name', 'email', 'address', 'no_phone', 'gender'];

    protected static function booted()
    {
        static::saving(function ($member) {
            $member->name = str::title($member->name);
            $member->address = str::title($member->address);
        });
    }

    public function borrowing(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
