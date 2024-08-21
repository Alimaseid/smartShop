<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferItemDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_item_id', 'item_id', 'item_name', 'quantity',
    ];

    public function transfer():BelongsTo
    {
        return $this->belongsTo(TransferItemDetail::class);
    }

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
