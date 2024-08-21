<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'item_id', 'unit', 'quantity', 'unit_price', 'total_price'];

    public function purchase():BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
