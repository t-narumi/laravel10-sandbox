<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'phone_number',
        'phone_model',
        'started_on',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
