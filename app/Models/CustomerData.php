<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'gender', 'street', 'street_number', 'zip',
        'city', 'customer_number', 'invoice_number', 'units', 'cost_per_unit', 'amount',
        'invoice_date', 'token'
    ];

}
