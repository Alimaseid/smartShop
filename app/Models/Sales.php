<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [ 'customer_id', 'store_id', 'invoice_no', 'date', 'sales_type', 'sub_total', 'discount', 'vat', 'total', 'remarks','isServiceSales'];

    public function details():HasMany
    {
        return  $this->hasMany(SalesDetails::class);
    }

    public function customer():BelongsTo
    {
        return  $this->belongsTo(Customer::class);
    }

    public function store():BelongsTo
    {
        return  $this->belongsTo(warehouse::class);
    }
}
