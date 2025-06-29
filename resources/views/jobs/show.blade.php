@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $job->title }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ $job->company }} — {{ $job->location }} ({{ $job->type }})</h6>
            <p class="card-text mt-3">{{ $job->description }}</p>
        </div>
    </div>
@endsection
