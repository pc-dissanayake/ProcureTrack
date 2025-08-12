<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementStage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'order',
        'is_active',
    ];
}
