@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Job
    </h2>
@endsection

@section('content')
@if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white shadow-md rounded-md">
    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf

        <!-- Job Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
            <input type="text" name="title" id="title" required
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
        </div>

        <!-- Company -->
        <div class="mb-4">
            <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
            <input type="text" name="company" id="company" required
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" required
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
        </div>

        <!-- Job Type -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                <select name="type" id="type" required
                 class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="">Select Job Type</option>
                     <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" required
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 h-32 resize-y"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
            Submit Job
        </button>
    </form>
</div>
@endsection
