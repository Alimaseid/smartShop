<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransferItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_from', 'location_to', 'transferred_by', 'received_by', 'rf_number', 'status','created_at','remark'
    ];
    public function details():HasMany
    {
        return $this->hasMany(TransferItemDetail::class);
    }

    public function from():BelongsTo
    {
        return $this->belongsTo(warehouse::class,'location_from');
    }

    public function to():BelongsTo
    {
        return $this->belongsTo(warehouse::class,'location_to');
    }
}
