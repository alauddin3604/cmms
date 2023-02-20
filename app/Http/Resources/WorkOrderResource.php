<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderResource extends JsonResource
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
            'date_finished' =>$this->date_finished,
            'remarks' => $this->remarks,
            'asset_id' => $this->asset->id,
            'asset_name' => $this->asset->name,
            'asset_barcode' => $this->asset->barcode,
            'asset_description' => $this->asset->description,
            'supervisor' => $this->supervisors->name,
            'technician' => $this->technicians->name
        ];
    }
}
