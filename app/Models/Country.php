<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id',
        'alpha_2',
        'alpha_3',
        'name',
    ];
}
