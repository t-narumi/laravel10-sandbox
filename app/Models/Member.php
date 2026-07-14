<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
