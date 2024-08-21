<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesQuotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'date',
        'expiration_date',
        'invoice_no',
        'payment_term',
        'due_date',
        'sub_total',
        'discount',
        'vat',
        'total',
    ];


    public function details():HasMany
    {
        return $this->hasMany(QuatationDetail::class);
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
