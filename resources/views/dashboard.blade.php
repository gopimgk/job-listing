@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('jobs.create') }}">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    + Add Job
                </button>
            </a>
        </div>

        <h2 class="text-2xl font-bold mb-4">Job Listings</h2>

        @include('jobs.index') {{-- Your grid with pagination --}}
    </div>
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection
