<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkOrderResource;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkOrderController extends Controller
{
    public function index()
    {
        $work_orders = WorkOrder::all();
        return WorkOrderResource::collection($work_orders);
    }

    public function add(Request $request)
    {
        WorkOrder::create([
            'work_order_id' => $this->generateWOId(),
            'priority' => $request->priority,
            'maintenance_type' => $request->maintenance_type,
            'status' => 'Pending',
            'remarks' => $request->remarks,
            'asset_id' => $request->asset_id,
            'supervisor_id' => $request->supervisor_id,
            'technician_id' => $request->technician_id,
        ]);

        return response()->json();
    }

    public function check($asset_id)
    {
        $work_order = WorkOrder::where([
            ['asset_id', '=', $asset_id],
            ['status', '=', 'Pending']
        ])->first();
        
        // 1 Pending, 0 Completed
        if ($work_order)
            return response()->json(1);
        else 
            return response()->json(0);
    }

    public function generateWOId()
    {
        do {
            $work_order_id = 'WO' . random_int(100000, 999999);
        } while (WorkOrder::where("work_order_id", "=", $work_order_id)->first());
  
        return $work_order_id;
    }
}
