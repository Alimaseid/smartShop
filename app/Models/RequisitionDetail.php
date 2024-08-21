<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequisitionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'quantity',
        'unit',
        'remarks',
        'requisition_id'
    ];

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
