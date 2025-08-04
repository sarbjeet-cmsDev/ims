<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
