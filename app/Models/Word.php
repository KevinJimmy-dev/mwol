<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id', 'user_id', 'name', 'translation'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function phrases(): HasMany
    {
        return $this->hasMany(Phrase::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
