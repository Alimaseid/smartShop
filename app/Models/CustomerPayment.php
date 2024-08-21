<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'amount', 'payment_type', 'check_or_transfer_id', 'remarks', 'created_at','payment_no'
    ];
}
