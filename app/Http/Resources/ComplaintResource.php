<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        // Retrieve the base resource data
        $data = parent::toArray($request);

        // Add additional fields based on conditions
        // if ($this->status == 'active') {
        //     $data['discounted_price'] = $this->price - $this->discount;
        // }

        $data['status'] = $this->status?->name;
        $data['category'] = $this->category?->name;
        $data['channel'] = $this->channel?->name;
        $data['org'] = $this->organization?->name;
        $data['energyType'] = $this->energyType?->name;
        $data['complaintType'] = $this->complaintType?->name;
        $data['complaintTypeSummary'] = $this->complaintTypeSummary?->name;
        $data['fileName'] = $this->file?->filename;
        $data['audioName'] = $this->audioFile?->filename;
        $data['fileUrl'] = $this->file_id ? URL::to('files/' . $this->file?->filename) : null;
        $data['audioUrl'] = $this->audio_file_id ? URL::to('files/' . $this->audioFile?->filename) : null;

        return $data;
    }
}
