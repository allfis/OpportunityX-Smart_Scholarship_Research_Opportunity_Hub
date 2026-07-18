<?php

namespace App\Http\Controllers\Opportunity;

use App\Models\Opportunity;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Http\Request;

class ListingController
{
    public function index(Request $request)
    {
        $query = Opportunity::active()->notExpired()->with(['country', 'category']);

        // Search by title or description
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        // Filter by degree level
        if ($request->filled('degree')) {
            $query->where('degree_level', $request->degree);
        }

        // Filter by funding type
        if ($request->filled('funding')) {
            $query->where('funding_type', $request->funding);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        match($sort) {
            'deadline_asc' => $query->orderBy('deadline', 'asc'),
            'funding_high' => $query->orderByDesc('funding_amount'),
            'funding_low' => $query->orderBy('funding_amount'),
            default => $query->latest(),
        };

        $opportunities = $query->paginate(12)->withQueryString();

        $countries = Country::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        // Get current type label for page heading
        $typeLabels = [
            'scholarship' => 'Scholarships',
            'research_grant' => 'Research Grants',
            'internship' => 'Internships',
            'fellowship' => 'Fellowships',
            'competition' => 'Competitions',
        ];
        $pageTitle = $typeLabels[$request->type] ?? 'All Opportunities';

        return view('opportunity.index', compact('opportunities', 'countries', 'categories', 'pageTitle'));
    }

    public function show(Opportunity $opportunity)
    {
        // Increment view count
        $opportunity->increment('views_count');

        $opportunity->load(['country', 'category', 'postedBy', 'typeDetail']);

        return view('opportunity.show', compact('opportunity'));
    }
}