<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorLedger extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_id', 'in', 'out', 'purchase_id', 'vendor_payment_id', 'current_balance', 'reason', 'status',];

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function purchase():BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function payment():BelongsTo
    {
        return $this->belongsTo(VendorPayment::class,'vendor_payment_id');
    }
}
