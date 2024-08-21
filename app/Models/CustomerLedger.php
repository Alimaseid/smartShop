<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerLedger extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'in', 'out', 'sales_id', 'customer_payment_id', 'current_balance', 'reason', 'status',];

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function sales():BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }

    public function payment():BelongsTo
    {
        return $this->belongsTo(CustomerPayment::class,'customer_payment_id');
    }
}
