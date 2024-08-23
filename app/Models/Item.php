<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'item_class',
        'cost_price',
        'is_active',
        'reorder_level',
        'retail_price',
        'whole_sale_price',
        'model',
        'unit',
        'weight',
        'dimension',
        'manufacturer',
        'part_number',
        'item_number',
        'image',
        'supplier_name',
        'serial_number',
        'bar_code',
        'description',
        'start_balance',
        'vendor_id'
    ];

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'item_id');
    }
    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class, 'item_id');
    }

    public function adjustment()
    {
        return $this->hasMany(InventoryAdjustment::class, 'item_id');
    }
}
