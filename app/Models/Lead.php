<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id',
        'name',
        'phone',
        'email',
        'notes',
        'type',
        'status',
    ];

    protected $casts = [
        'home_id' => 'integer',
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class);
    }
}