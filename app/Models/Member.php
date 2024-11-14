<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $fillable = ['name', 'email', 'address', 'no_phone'];

    public function borrowing(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
