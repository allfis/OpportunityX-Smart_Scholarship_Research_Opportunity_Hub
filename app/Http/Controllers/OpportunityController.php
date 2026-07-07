<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Resources\OpportunityResource;
use App\Models\ActivityLog;
use App\Models\Bookmark;
use App\Models\Country;
use App\Models\FieldOfStudy;
use App\Models\Opportunity;
use App\Models\OpportunityType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Opportunity::active()
            ->with(['type', 'field', 'country', 'postedBy.university']);

        if ($request->filled('type') && $request->type !== 'all') {
            $query->ofType($request->type);
        }
        if ($request->filled('field')) {
            $query->whereHas('field', fn($q) => $q->where('slug', $request->field));
        }
        if ($request->filled('country')) {
            $query->whereHas('country', fn($q) => $q->where('code', $request->country));
        }
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        if ($request->boolean('featured')) {
            $query->featured();
        }

        $query->orderByDesc('is_featured')->orderBy('deadline');

        $opps = $query->paginate($request->get('limit', 20));

        if (session('user_id')) {
            $bookmarked = Bookmark::where('user_id', session('user_id'))
                ->whereIn('opportunity_id', $opps->pluck('id'))
                ->pluck('opportunity_id')
                ->toArray();

            foreach ($opps as $opp) {
                $opp->is_bookmarked = in_array($opp->id, $bookmarked);
            }
        }

        return $this->success([
            'data' => OpportunityResource::collection($opps),
            'total' => $opps->total(),
            'page' => $opps->currentPage(),
            'pages' => $opps->lastPage(),
        ]);
    }

    public function show($id)
    {
        $opp = Opportunity::active()
            ->with(['type', 'field', 'country', 'postedBy.university'])
            ->findOrFail($id);

        $opp->increment('views_count');

        $opp->is_bookmarked = false;
        if (session('user_id')) {
            $opp->is_bookmarked = Bookmark::where('user_id', session('user_id'))
                ->where('opportunity_id', $id)
                ->exists();
        }

        return $this->success(new OpportunityResource($opp));
    }

    public function store(StoreOpportunityRequest $request)
    {
        $opp = Opportunity::create(
            $request->validated() + ['posted_by' => session('user_id')]
        );

        ActivityLog::create([
            'user_id' => session('user_id'),
            'action' => 'opportunity_posted',
            'description' => "Posted: {$opp->title}",
            'ip_address' => $request->ip(),
        ]);

        return $this->success(['id' => $opp->id], 'Opportunity posted', 201);
    }

    public function filters()
    {
        return $this->success([
            'types' => OpportunityType::orderBy('sort_order')->get(),
            'fields' => FieldOfStudy::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get(),
        ]);
    }

    public function deadlines()
    {
        $opps = Opportunity::active()
            ->with(['type', 'field', 'country'])
            ->orderBy('deadline')
            ->limit(20)
            ->get();

        return $this->success(OpportunityResource::collection($opps));
    }
}