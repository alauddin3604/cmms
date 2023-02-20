<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'priority',
        'maintenance_type',
        'status',
        'date_finished',
        'remarks',
        'asset_id',
        'supervisor_id',
        'technician_id'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function supervisors()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function technicians()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }
}
