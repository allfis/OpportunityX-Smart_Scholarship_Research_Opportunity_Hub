<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'organization' => $this->organization,
            'amount' => $this->amount,
            'deadline' => $this->deadline->format('Y-m-d'),
            'eligibility_criteria' => $this->eligibility_criteria,
            'application_url' => $this->application_url,
            'is_featured' => $this->is_featured,
            'views_count' => $this->views_count,
            'applications_count' => $this->applications_count,
            'days_remaining' => $this->days_remaining,
            'deadline_status' => $this->deadline_status,
            'type' => [
                'id' => $this->whenLoaded('type')->id,
                'name' => $this->whenLoaded('type')->name,
                'slug' => $this->whenLoaded('type')->slug,
                'badge_class' => $this->whenLoaded('type')->badge_class,
                'color' => $this->whenLoaded('type')->color,
            ],
            'field' => [
                'id' => $this->whenLoaded('field')->id,
                'name' => $this->whenLoaded('field')->name,
                'slug' => $this->whenLoaded('field')->slug,
            ],
            'country' => [
                'id' => $this->whenLoaded('country')->id,
                'name' => $this->whenLoaded('country')->name,
                'code' => $this->whenLoaded('country')->code,
            ],
            'posted_by' => $this->whenLoaded('postedBy') ? [
                'id' => $this->whenLoaded('postedBy')->id,
                'name' => $this->whenLoaded('postedBy')->name,
                'university' => $this->whenLoaded('postedBy.university')
                    ? $this->whenLoaded('postedBy.university')->name
                    : null,
            ] : null,
            'is_bookmarked' => $this->whenLoaded('is_bookmarked'),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}