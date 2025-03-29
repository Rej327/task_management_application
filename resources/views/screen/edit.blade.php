@extends('layout')

@section('content')
@include('components.background')
<div class="relative bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h1 class="text-center text-3xl mb-4">Task Management Application</h1>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Task</h2>

    {{-- @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full p-2 border rounded 
                @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}" class="w-full p-2 border rounded 
                @error('due_date') border-red-500 @enderror">
            @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end items-center gap-4">
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update Task</button>
        </div>
    </form>
</div>
@endsection