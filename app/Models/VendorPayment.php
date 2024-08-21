<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'amount', 'payment_type', 'check_or_transfer_id', 'remarks', 'created_at'
    ];

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
