<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'pan',
        'address',
        'pincode',
        'amount',
        'payment_method',
        'transaction_id',
        'urn',
        'status',
        'qr_code'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}