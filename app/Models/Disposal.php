<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse_id', 'item_id', 'quantity', 'unit_price', 'total_price',
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
