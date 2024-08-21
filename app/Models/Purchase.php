<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
            'vendor_id',
            'requisition_id',
            'invoice_no',
            'total',
            'tax',
            'vendor_invoice_no',
            'remark',
            'subtotal',
            'discount',
            'warehouse_id'
         ];

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function warehouse():BelongsTo
    {
        return $this->belongsTo(warehouse::class);
    }

    public function requisition():BelongsTo
    {
        return $this->belongsTo(Requisition::class);
    }


    public function details():HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
