<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $fillable = [
        'vendor_id',
        'title',
        'description',
        'requested_by',
        'requested_at',
        'status',
        'amount',
        'approved_at',
        'approved_by',
        'ordered_at',
        'delivered_at',
        'delivery_status',
        'remarks',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
