<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;

class JobController extends Controller
{
    //
    public function index()
    {
        return JobResource::collection(Job::latest()->get());
    }
    public function show($id)
    {
        // return new JobResource(Job::findOrFail($id));
        $jobs=Job::findOrFail($id);
        return view('jobs.show', [
            'job' => $jobs,
        ]);
    }

     public function store(StoreJobRequest $request)
    {
        // dd(auth()->user());
        $job = auth()->user()->jobs()->create($request->validated());
        if ($request->expectsJson() || $request->is('api/*')) {
        return new JobResource($job); // For API route
        }
        // return new JobResource($job);
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function update(UpdateJobRequest $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->validated());
        return new JobResource($job);
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(['message' => 'Job deleted']);
    }

     public function dashboard()
    {
        $jobs = \App\Models\Job::where("user_id", auth()->id())->latest()->paginate(10);;
        return view('dashboard', [
            'jobs' => $jobs,
        ]);
    }
}
