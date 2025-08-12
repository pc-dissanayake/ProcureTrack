<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'contacts', // JSON array of contact persons with position, phones, emails
        'address',
        'city',
        'country',
        'notes',
    ];

    protected $casts = [
        'contacts' => 'array',
    ];

    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }
}
