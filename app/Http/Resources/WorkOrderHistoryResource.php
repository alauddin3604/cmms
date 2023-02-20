<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'work_order_id' => $this->work_order_id,
            'priority' => $this->priority,
            'maintenance_type' => $this->maintenance_type,
            'status' => $this->status,
            'date_assigned' =>$this->date_assigned,
            'date_finished' =>$this->date_finished,
            'remarks' => $this->remarks,
            'asset_name' => $this->asset_name,
            'supervisor_name' => $this->supervisor_name,
            'technician_name' => $this->technician_name
        ];
    }
}
