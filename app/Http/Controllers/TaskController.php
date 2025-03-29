<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    // Display a list of tasks, default filtered by the due date field in ascending order
    public function index()
    {
        $tasks = Task::orderBy('due_date', 'asc')->paginate(8);
        return view('screen.index', compact('tasks'));
    }

    // Show create task form
    public function create()
    {
        return view('screen.create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:50', Rule::unique('tasks')],
            'description' => ['nullable', 'string', 'max:500'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 5 characters.',
            'title.max' => 'The title must not exceed 100 characters.',
            'title.unique' => 'A task with this title already exists.',
            'due_date.required' => 'Please set a due date.',
            'due_date.after_or_equal' => 'The due date must be today or later.',
        ]);
    
        Task::create($request->all());
    
        return redirect()->route('tasks.index')->with('add', 'Task created successfully!');
    }

    // Show edit form
    public function edit(Task $task)
    {
        return view('screen.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:100', Rule::unique('tasks')->ignore($task->id)],
            'description' => ['nullable', 'string', 'max:500'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 5 characters.',
            'title.max' => 'The title must not exceed 100 characters.',
            'title.unique' => 'A task with this title already exists.',
            'due_date.required' => 'Please set a due date.',
            'due_date.after_or_equal' => 'The due date must be today or later.',
        ]);
    
        $task->update($request->all());
    
        return redirect()->route('tasks.index')->with('update', 'Task updated successfully!');
    }

    // Delete task returning success response in JSON format for AJAX
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json(['success' => true, 'message' => 'Task deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete task.'], 500);
        }
    }

    
    // Toggle task as complete or pending returning response in JSON format for AJAX
    public function toggleStatus(Task $task)
    {
        $task->status = !$task->status;
        $task->save();
    
        return response()->json([
            'success' => true,
            'status' => $task->status,
        ]);
    }
    
    
}
