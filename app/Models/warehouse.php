<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'manage_by', 'address', 'value', 'no_items', 'description',
    ];
}
