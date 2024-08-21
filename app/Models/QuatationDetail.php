<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuatationDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sales_quotation_id', 'item_id', 'unit', 'unit_price', 'quantity', 'amount', 'description', ];

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function qoutation():BelongsTo
    {
        return $this->belongsTo(SalesQuotation::class);
    }
}
