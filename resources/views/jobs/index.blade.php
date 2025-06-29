@if($jobs->count())
    <!-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> -->
        <!-- @foreach($jobs as $job)
            <div class="bg-gray-100 rounded-xl p-4 shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-800">{{ $job->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($job->description, 100) }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-600 hover:underline text-sm">View</a>
                </div>
            </div>
        @endforeach -->

        <div class="overflow-x-auto bg-white rounded-xl shadow"> 
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Posted</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
            @forelse($jobs as $job)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        {{ $job->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Illuminate\Support\Str::limit($job->description, 60) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $job->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-600 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No job listings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> 

    <!-- </div> -->

    <div class="mt-6">
        {{ $jobs->links() }} {{-- Tailwind-compatible pagination --}}
    </div>
@else
    <p class="text-gray-500">No jobs found.</p>
@endif
