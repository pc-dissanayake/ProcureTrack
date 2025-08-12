<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LKCity extends Model
{

    protected $table ="cities";


    protected $fillable = [
        'district_id',
        'name_en',
        'name_si',
        'name_ta',
        'sub_name_en',
        'sub_name_si',
        'sub_name_ta',
        'postcode',
        'latitude',
        'longitude',
    ];
}
