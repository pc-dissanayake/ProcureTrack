<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'website',
        'company_email',
        'company_phone',
        'contacts', // JSON array of contact persons with position, phones, emails
        'address',
        'city',
        'country',
        'notes',
        'tags',
    ];

    protected $casts = [
        'company_email' => 'array',
        'company_phone' => 'array',
        'contacts' => 'array',
        'tags' => 'array',
    ];

    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }
}
