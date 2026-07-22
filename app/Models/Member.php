<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'withdrawn_on',
    ];

    protected $casts = [
        'withdrawn_on' => 'date',
    ];

    public function scopeWithdrawn(Builder $query): Builder
    {
        return $query->whereNotNull('withdrawn_on');
    }

    public function scopeReachedValidAge(Builder $query): Builder
    {
        return $query->where('age', '<', 40);
    }

    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
