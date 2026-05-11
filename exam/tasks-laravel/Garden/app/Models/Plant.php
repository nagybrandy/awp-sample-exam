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

    // TODO (L2.e): Define a belongsToMany(User::class, ...) relation on the
    //              `plant_user` pivot table (matches the migration from L2.a–c).
}
