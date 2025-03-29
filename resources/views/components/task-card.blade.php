<div id="task-{{$task->id}}" class="relative flex flex-col gap-2 mt-4 p-4 border rounded bg-gray-100 shadow-md w-80 transition duration-200 ease-in-out hover:bg-gray-200 group">
    <h2 class="text-lg font-semibold border-b-2 pb-2 mb-2">{{ $task->title }}</h2>
    <p class="text-sm text-gray-700">{{ $task->description }}</p>
    <p class="text-gray-500 text-sm">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</p>
    <p class="text-sm font-bold text-gray-800">
        Status: 
        <span id="status-text-{{ $task->id }}" class="{{ $task->status ? 'text-[#00D26A]' : 'text-[#F92F60]' }}">
            {{ $task->status ? 'Completed ✅' : 'Pending ❌' }}
        </span>
    </p>

    <!-- Icons for Edit & Delete (Shown on Hover) -->
    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 flex space-x-2">
        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">📝</a>
        <button type="button" onclick="confirmDelete({{ $task->id }})"  class="text-red-500 hover:text-red-700">🗑️</button>
    </div>

    <!-- Toggle Status Button -->
    <button id="toggle-status-{{ $task->id }}"
            class="toggle-status-button mt-2 px-4 py-2 rounded text-white text-sm w-full
            {{ $task->status ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}"
            data-task-id="{{ $task->id }}">
        {{ $task->status ? 'Mark as Pending' : 'Mark as Completed' }}
    </button>
</div>
