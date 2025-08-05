<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'contact_person',
        'customer_type',
        'tax_id',
        'status',
        'notes',
        'credit_limit',
        'total_purchases',
        'last_purchase_at',
        'registered_at',
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'total_purchases' => 'decimal:2',
        'last_purchase_at' => 'datetime',
        'registered_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
