<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'requested_by',
        'requested_at',
        'status',
        'amount',
        'vendor',
        'approved_at',
        'approved_by',
        'ordered_at',
        'delivered_at',
        'delivery_status',
        'remarks',
    ];
}
