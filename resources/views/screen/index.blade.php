@extends('layout')

@section('content')
@include('components.background')
<div class="relative bg-white p-6 rounded shadow pb-10">
    <div id="toast-container" class="absolute right-10 z-50 p-2 rounded"></div>
    <h1 class="text-center text-3xl mb-4">Task Management Application</h1>
    <h2 class="text-2xl mb-4">Feature Request</h2>
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add Task</a>

    <!-- Loading Indicator (Spinning Loader) -->
    <div id="loadingIndicator" class="flex justify-center mt-4">
        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-blue-500 border-solid"></div>
    </div>

    <!-- Task List Container -->
    <div id="taskList" class="flex flex-wrap justify-baseline gap-4 mt-4 hidden">
        @foreach($tasks as $task)
            @include('components.task-card', ['task' => $task])
        @endforeach
    </div>

    <!-- No Data Available Message -->
    <div id="noDataMessage" class="text-center mt-4 text-gray-500 hidden">
        No tasks available.
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $tasks->links('.components.custom-pagination') }}
    </div>
</div>
@if (session('add'))
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            showToast("{{ session('add') }}", "add");
        });
    </script>
@endif
@if (session('update'))
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            showToast("{{ session('update') }}", "update");
        });
    </script>
@endif
@include('components.delete-modal')
@endsection
