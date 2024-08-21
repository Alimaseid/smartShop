<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssuingDetails extends Model
{
    use HasFactory;

    protected $fillable = ['issuing_id', 'item_id', 'quantity', 'unit', 'unit_price'];

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function issue():BelongsTo
    {
        return $this->belongsTo(Issuing::class);
    }
}
