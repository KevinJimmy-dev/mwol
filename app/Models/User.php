<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['admin_id', 'name', 'nickname', 'email', 'password', 'remember_token'];

    protected $hidden = ['password', 'remember_token'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function words(): HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function phrases(): HasMany
    {
        return $this->hasMany(Phrase::class);
    }
}
