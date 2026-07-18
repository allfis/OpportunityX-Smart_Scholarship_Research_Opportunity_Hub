@extends('layouts.app')
@section('title', $opportunity->title)
@section('content')
<section class="py-10 bg-[var(--blue-25)]">
    <div class="max-w-4xl mx-auto px-5 lg:px-8">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-8 fade-up">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ route('opportunities.index') }}" class="hover:text-blue-600 transition-colors">Opportunities</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-gray-700 font-medium truncate">{{ Str::limit($opportunity->title, 40) }}</span>
        </div>

        <div class="bg-white rounded-2xl border border-blue-50 overflow-hidden fade-up fade-up-delay-1">
            {{-- Color bar --}}
            <div class="h-2 bg-gradient-to-r {{ $opportunity->type === 'scholarship' ? 'from-blue-500 to-blue-400' : ($opportunity->type === 'research_grant' ? 'from-emerald-500 to-emerald-400' : ($opportunity->type === 'internship' ? 'from-violet-500 to-violet-400' : ($opportunity->type === 'fellowship' ? 'from-amber-500 to-amber-400' : 'from-rose-500 to-rose-400'))) }}"></div>

            <div class="p-8 sm:p-10">
                {{-- Badges --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="badge {{ $opportunity->type === 'scholarship' ? 'badge-blue' : ($opportunity->type === 'research_grant' ? 'badge-green' : ($opportunity->type === 'internship' ? 'badge-violet' : ($opportunity->type === 'fellowship' ? 'badge-amber' : 'badge-rose'))) }}">{{ $opportunity->typeLabel() }}</span>
                    <span class="badge badge-blue">{{ ucfirst($opportunity->degree_level) }}</span>
                    @if($opportunity->funding_type !== 'none')<span class="badge badge-green">{{ ucfirst($opportunity->funding_type) }} Funded</span>@endif
                </div>

                {{-- Title --}}
                <h1 class="text-2xl sm:text-3xl font-display text-gray-900 mb-4 leading-tight">{{ $opportunity->title }}</h1>

                {{-- Meta grid --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 p-5 bg-[var(--blue-25)] rounded-xl">
                    @if($opportunity->country)
                        <div class="text-center">
                            <p class="text-2xl mb-1">{{ $opportunity->country->flag_emoji }}</p>
                            <p class="text-xs text-gray-500">Country</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $opportunity->country->name }}</p>
                        </div>
                    @endif
                    @if($opportunity->funding_amount)
                        <div class="text-center">
                            <p class="text-xl mb-1"><i class="fas fa-dollar-sign text-emerald-500"></i></p>
                            <p class="text-xs text-gray-500">Funding</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $opportunity->formattedFunding() }}</p>
                        </div>
                    @endif
                    @if($opportunity->deadline)
                        <div class="text-center">
                            <p class="text-xl mb-1"><i class="fas fa-calendar text-blue-500"></i></p>
                            <p class="text-xs text-gray-500">Deadline</p>
                            <p class="text-sm font-semibold {{ $opportunity->isDeadlineApproaching() ? 'text-rose-500' : 'text-gray-800' }}">{{ $opportunity->deadline->format('M d, Y') }}</p>
                        </div>
                    @endif
                    <div class="text-center">
                        <p class="text-xl mb-1"><i class="fas fa-eye text-gray-400"></i></p>
                        <p class="text-xs text-gray-500">Views</p>
                        <p class="text-sm font-semibold text-gray-800">{{ number_format($opportunity->views_count) }}</p>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <h3 class="font-bold text-gray-900 mb-3 text-lg">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $opportunity->description }}</p>
                </div>

                {{-- Type-specific details --}}
                @if($opportunity->typeDetail)
                    <div class="mb-8 p-6 border border-blue-50 rounded-xl bg-[var(--blue-25)]">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg">{{ $opportunity->typeLabel() }} Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            @foreach($opportunity->typeDetail->toArray() as $key => $value)
                                @if(!in_array($key, ['id', 'opportunity_id', 'created_at', 'updated_at']) && $value !== null)
                                    <div>
                                        <span class="text-gray-400 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                        <span class="font-medium text-gray-700 ml-1">
                                            @if(is_array($value))
                                                {{ implode(', ', $value) }}
                                            @elseif(is_bool($value))
                                                {{ $value ? 'Yes' : 'No' }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Eligibility --}}
                @if($opportunity->eligibility_criteria)
                    <div class="mb-8 p-6 border border-amber-100 rounded-xl bg-amber-50/30">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg"><i class="fas fa-shield-halved text-amber-500 mr-2"></i>Eligibility Criteria</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            @foreach($opportunity->eligibility_criteria as $key => $value)
                                <div>
                                    <span class="text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                    <span class="font-medium text-gray-700 ml-1">
                                        @if(is_array($value)){{ implode(', ', $value) }}@else{{ $value }}@endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="flex flex-wrap gap-3 pt-6 border-t border-blue-50">
                    @if($opportunity->apply_url)
                        <a href="{{ $opportunity->apply_url }}" target="_blank" class="btn btn-primary btn-lg"><i class="fas fa-external-link-alt"></i> Apply Now</a>
                    @endif
                    <button onclick="toggleBookmark(this)" class="btn btn-outline btn-lg" data-id="{{ $opportunity->id }}"><i class="far fa-heart"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function toggleBookmark(btn){
    const id=btn.dataset.id;
    fetch('/bookmarks/toggle',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({opportunity_id:id})})
    .then(r=>r.json()).then(d=>{
        const icon=btn.querySelector('i');
        if(d.bookmarked){icon.className='fas fa-heart text-rose-500';btn.innerHTML='<i class="fas fa-heart text-rose-500"></i> Saved'}
        else{icon.className='far fa-heart';btn.innerHTML='<i class="far fa-heart"></i> Save'}
    });
}
</script>
@endpush
@endsection