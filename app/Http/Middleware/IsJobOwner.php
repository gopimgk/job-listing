<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Job;
use Illuminate\Http\Request;

class IsJobOwner
{
    public function handle(Request $request, Closure $next)
    {
        $job = Job::findOrFail($request->route('id'));

        if ($job->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}

