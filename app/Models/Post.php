<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'post_content',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
