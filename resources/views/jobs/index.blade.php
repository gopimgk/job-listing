@if($jobs->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($jobs as $job)
            <div class="bg-gray-100 rounded-xl p-4 shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-800">{{ $job->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($job->description, 100) }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-600 hover:underline text-sm">View</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $jobs->links() }} {{-- Tailwind-compatible pagination --}}
    </div>
@else
    <p class="text-gray-500">No jobs found.</p>
@endif
