@extends('layout')
@section('content')
@include('components.background')
<div class="relative bg-white p-6 rounded shadow m-auto max-w-lg m-auto">
    <h1 class="text-center text-3xl mb-4">Task Management Application</h1>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Create Task</h2>

    {{-- @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full p-2 border rounded 
                @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full p-2 border rounded 
                @error('due_date') border-red-500 @enderror">
            @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end items-center gap-4">
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Task</button>
        </div>
    </form>
</div>
@endsection
