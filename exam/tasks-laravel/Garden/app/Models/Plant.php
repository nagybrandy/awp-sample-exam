<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'spot',
        'care_note',
    ];

    // TODO (L2): belongsTo User (creator) on `user_id`; belongsToMany User — pivot `plant_user`
}
