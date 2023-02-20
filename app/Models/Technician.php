<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ic_number',
        'email',
        'phone_number',
        'password',
        'address',
    ];

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
