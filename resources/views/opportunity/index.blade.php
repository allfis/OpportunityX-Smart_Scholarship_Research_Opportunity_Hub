@extends('layouts.app')
@section('title', $pageTitle ?? 'Opportunities')
@section('content')
<section class="py-10 bg-[var(--blue-25)] relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8 fade-up">
            <span class="section-label">Browse</span>
            <h1 class="section-title mt-2">{{ $pageTitle }}</h1>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('opportunities.index') }}" class="mb-6 fade-up fade-up-delay-1">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search scholarships, grants, internships..." class="form-input pl-11 py-3">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                @if(request()->hasAny(['search','type','country','degree','funding','category']))
                    <a href="{{ route('opportunities.index') }}" class="btn btn-outline"><i class="fas fa-times"></i> Clear</a>
                @endif
            </div>
        </form>

        {{-- Filter Buttons Row --}}
        <div class="flex flex-wrap gap-2 mb-4 fade-up fade-up-delay-2">
            <a href="{{ route('opportunities.index') }}" class="filter-btn {{ !request('type') ? 'active' : }}">
                <i class="fas fa-globe text-xs mr-1"></i> All
            </a>
            <a href="{{ route('opportunities.index', ['type' => 'scholarship']) }}" class="filter-btn {{ request('type') === 'scholarship' ? 'active' : }}">
                <i class="fas fa-graduation-cap text-xs mr-1"></i> Scholarships
            </a>
            <a href="{{ route('opportunities.index', ['type' => 'research_grant']) }}" class="filter-btn {{ request('type') === 'research_grant' ? 'active' : }}">
                <i class="fas fa-flask text-xs mr-1"></i> Research Grants
            </a>
            <a href="{{ route('opportunities.index', ['type' => 'internship']) }}" class="filter-btn {{ request('type') === 'internship' ? 'active' : }}">
                <i class="fas fa-building text-xs mr-1"></i> Internships
            </a>
            <a href="{{ route('opportunities.index', ['type' => 'fellowship']) }}" class="filter-btn {{ request('type') === 'fellowship' ? 'active' : }}">
                <i class="fas fa-award text-xs mr-1"></i> Fellowships
            </a>
            <a href="{{ route('opportunities.index', ['type' => 'competition']) }}" class="filter-btn {{ request('type') === 'competition' ? 'active' : }}">
                <i class="fas fa-trophy text-xs mr-1"></i> Competitions
            </a>
        </div>

        {{-- Advanced Filters --}}
        <div class="bg-white rounded-2xl border border-blue-50 p-5 mb-8 fade-up fade-up-delay-3">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="form-label text-xs">Country</label>
                    <select name="country" class="form-input py-2.5 text-sm" onchange="this.form.submit()">
                        <option value="">All Countries</option>
                        @foreach($countries as $c)
                            <option value="{{ $c->id }}" {{ request('country') == $c->id ? 'selected' : '' }}>{{ $c->flag_emoji }} {{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label text-xs">Degree Level</label>
                    <select name="degree" class="form-input py-2.5 text-sm" onchange="this.form.submit()">
                        <option value="">Any Degree</option>
                        <option value="undergraduate" {{ request('degree') === 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                        <option value="masters" {{ request('degree') === 'masters' ? 'selected' : '' }}>Masters</option>
                        <option value="phd" {{ request('degree') === 'phd' ? 'selected' : '' }}>PhD</option>
                        <option value="postdoc" {{ request('degree') === 'postdoc' ? 'selected' : '' }}>Postdoc</option>
                    </select>
                </div>
                <div>
                    <label class="form-label text-xs">Funding</label>
                    <select name="funding" class="form-input py-2.5 text-sm" onchange="this.form.submit()">
                        <option value="">Any Funding</option>
                        <option value="full" {{ request('funding') === 'full' ? 'selected' : '' }}>Fully Funded</option>
                        <option value="partial" {{ request('funding') === 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="none" {{ request('funding') === 'none' ? 'selected' : '' }}>Unfunded</option>
                    </select>
                </div>
                <div>
                    <label class="form-label text-xs">Sort By</label>
                    <select name="sort" class="form-input py-2.5 text-sm" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="deadline_asc" {{ request('sort') === 'deadline_asc' ? 'selected' : '' }}>Deadline Soon</option>
                        <option value="funding_high" {{ request('sort') === 'funding_high' ? 'selected' : '' }}>Highest Funding</option>
                        <option value="funding_low" {{ request('sort') === 'funding_low' ? 'selected' : '' }}>Lowest Funding</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Results Count --}}
        <div class="flex items-center justify-between mb-6 fade-up">
            <p class="text-sm text-gray-500">
                Showing <span class="font-semibold text-gray-800">{{ $opportunities->count() }}</span> of <span class="font-semibold text-gray-800">{{ $opportunities->total() }}</span> opportunities
            </p>
        </div>

        {{-- Opportunity Cards Grid --}}
        @if($opportunities->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($opportunities as $opp)
                    <a href="{{ route('opportunities.show', $opp) }}" class="opp-card block fade-up">
                        {{-- Color bar by type --}}
                        <div class="opp-card-type bg-gradient-to-r {{ $opp->type === 'scholarship' ? 'from-blue-500 to-blue-400' : ($opp->type === 'research_grant' ? 'from-emerald-500 to-emerald-400' : ($opp->type === 'internship' ? 'from-violet-500 to-violet-400' : ($opp->type === 'fellowship' ? 'from-amber-500 to-amber-400' : 'from-rose-500 to-rose-400'))) }}"></div>

                        <div class="p-6">
                            {{-- Badges row --}}
                            <div class="flex items-center gap-2 mb-3 flex-wrap">
                                <span class="badge {{ $opp->type === 'scholarship' ? 'badge-blue' : ($opp->type === 'research_grant' ? 'badge-green' : ($opp->type === 'internship' ? 'badge-violet' : ($opp->type === 'fellowship' ? 'badge-amber' : 'badge-rose'))) }}">{{ $opp->typeLabel() }}</span>
                                @if($opp->funding_type === 'full')
                                    <span class="badge badge-green">Fully Funded</span>
                                @elseif($opp->funding_type === 'partial')
                                    <span class="badge badge-amber">Partial</span>
                                @endif
                                @if($opp->is_featured)
                                    <span class="badge badge-cyan"><i class="fas fa-star text-[9px] mr-1"></i>Featured</span>
                                @endif
                            </div>

                            {{-- Title --}}
                            <h3 class="font-bold text-gray-900 mb-2 leading-snug text-[15px]">{{ Str::limit($opp->title, 60) }}</h3>

                            {{-- Meta info --}}
                            <div class="flex flex-wrap gap-3 mb-4 text-xs text-gray-400">
                                @if($opp->country)
                                    <span class="flex items-center gap-1"><span>{{ $opp->country->flag_emoji }}</span> {{ $opp->country->name }}</span>
                                @endif
                                @if($opp->degree_level !== 'any')
                                    <span class="flex items-center gap-1"><i class="fas fa-graduation-cap"></i> {{ ucfirst($opp->degree_level) }}</span>
                                @endif
                            </div>

                            {{-- Bottom row: funding + deadline --}}
                            <div class="flex items-center justify-between pt-4 border-t border-blue-50">
                                <div>
                                    @if($opp->funding_amount)
                                        <p class="text-sm font-bold text-gray-800">{{ $opp->formattedFunding() }}</p>
                                    @else
                                        <p class="text-sm font-medium text-gray-400">No funding</p>
                                    @endif
                                </div>
                                @if($opp->deadline)
                                    <div class="text-right">
                                        @if($opp->isDeadlineApproaching())
                                            <p class="text-xs font-semibold text-rose-500"><i class="fas fa-clock mr-1"></i>{{ $opp->deadline->diffForHumans() }}</p>
                                        @else
                                            <p class="text-xs text-gray-400"><i class="far fa-calendar mr-1"></i>{{ $opp->deadline->format('M d, Y') }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center fade-up">
                {{ $opportunities->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-20 fade-up">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-search text-blue-300 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-2">No opportunities found</h3>
                <p class="text-sm text-gray-400 mb-6">Try adjusting your search or filters</p>
                <a href="{{ route('opportunities.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-times"></i> Clear All Filters</a>
            </div>
        @endif

    </div>
</section>
@endsection