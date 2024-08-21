<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable = [
        'requested_by',
        'requisition_no',
        'requisition_date',
        'status',
        'isTrash',
        'description_title',
        'description',
    ];

    public function requisitionDetails():HasMany
    {
        return $this->hasMany(RequisitionDetail::class);
    }
}
