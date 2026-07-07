<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpportunityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type_id' => 'required|exists:opportunity_types,id',
            'title' => 'required|max:300',
            'description' => 'required|string',
            'organization' => 'required|max:200',
            'field_id' => 'required|exists:fields_of_study,id',
            'country_id' => 'required|exists:countries,id',
            'amount' => 'nullable|max:100',
            'deadline' => 'required|date|after:today',
            'eligibility_criteria' => 'nullable|string',
            'application_url' => 'nullable|url|max:500',
            'is_featured' => 'nullable|boolean',
        ];
    }
}