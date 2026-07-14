<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
