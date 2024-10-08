<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['item_id','warehouse_id','quantity'];

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function warehouse():BelongsTo
    {
        return $this->belongsTo(warehouse::class);
    }
}
