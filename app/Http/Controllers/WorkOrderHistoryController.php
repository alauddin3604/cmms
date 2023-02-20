<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkOrderHistoryResource;
use App\Models\WorkOrderHistory;
use Illuminate\Http\Request;

class WorkOrderHistoryController extends Controller
{
    public function index()
    {
        $work_order_histories = WorkOrderHistory::all();
        return WorkOrderHistoryResource::collection($work_order_histories);
    }
}
