<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintStepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['org'] = $this->org->name;
        $data['status'] = $this->status->name;
        $data['desc'] = $this->desc;
        $data['date'] = $this->sent_date;

        return $data;
    }
}
