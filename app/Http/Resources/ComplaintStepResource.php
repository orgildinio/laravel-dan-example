<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
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
        $data['fileName'] = $this->file?->filename;
        $data['filaurl'] = $this->file_id ? URL::to('files/' . $this->file?->filename) : null;

        return $data;
    }
}