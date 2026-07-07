<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'opportunity_id' => $this->opportunity_id,
            'opportunity_title' => $this->whenLoaded('opportunity')->title,
            'opportunity_org' => $this->whenLoaded('opportunity')->organization,
            'opportunity_amount' => $this->whenLoaded('opportunity')->amount,
            'opportunity_type' => $this->whenLoaded('opportunity.type')->name,
            'opportunity_badge' => $this->whenLoaded('opportunity.type')->badge_class,
            'status_id' => $this->status_id,
            'status_name' => $this->whenLoaded('status')->name,
            'status_slug' => $this->whenLoaded('status')->slug,
            'status_color' => $this->whenLoaded('status')->color_class,
            'applied_date' => $this->applied_date->format('Y-m-d'),
            'notes' => $this->notes,
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}