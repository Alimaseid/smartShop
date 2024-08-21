<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryAdjustment extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse_id', 'item_id', 'quantity', 'adjustment_type', 'adjustment_date','remarks',
    ];

    public function warehouse():BelongsTo
    {
        return $this->belongsTo(warehouse::class);
    }

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

}
