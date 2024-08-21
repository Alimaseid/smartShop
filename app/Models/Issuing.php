<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Issuing extends Model
{
    use HasFactory;
    protected $fillable = ['from', 'issuing_no', 'requested_by', 'date', 'total_quantity', 'remarks','status','received_by'];

    public function store():BelongsTo
    {
        return $this->belongsTo(warehouse::class,'from');
    }

    public function details():HasMany
    {
        return $this->hasMany(IssuingDetails::class);
    }
}
