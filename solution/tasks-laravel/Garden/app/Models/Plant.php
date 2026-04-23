<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'spot',
        'care_note',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tenders(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
