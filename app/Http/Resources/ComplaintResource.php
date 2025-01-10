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
        // Retrieve the base resource data
        $data = parent::toArray($request);

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

        // Include associated files
        $data['files'] = $this->files->map(function ($file) {
            return [
                'id' => $file->id,
                'filename' => $file->filename,
                'url' => URL::to('files/' . $file->filename),
                'created_at' => $file->created_at->toDateTimeString(),
            ];
        });

        // Include audio information if needed
        $data['audio'] = $this->audioFile ? [
            'id' => $this->audioFile->id,
            'filename' => $this->audioFile->filename,
            'url' => URL::to('files/' . $this->audioFile->filename),
        ] : null;

        return $data;
    }
}
