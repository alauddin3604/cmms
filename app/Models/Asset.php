<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Asset extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'barcode',
        'name',
        'description'
    ];

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
