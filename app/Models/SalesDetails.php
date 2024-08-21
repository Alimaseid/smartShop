<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDetails extends Model
{
    use HasFactory;

    protected $fillable = ['sales_id', 'item_id', 'quantity', 'unit', 'unit_price', 'total'];

    public function sales():BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
