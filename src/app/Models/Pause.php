<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pause extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
    ];

    public $timestamps = false;

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
}
