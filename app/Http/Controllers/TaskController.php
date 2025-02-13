<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('position')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $task = Task::create($request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
        return redirect('/');
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
        return redirect('/');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/');
    }

    public function toggleCompletion(Task $task)
    {
        $task->update(['completed' => !$task->completed]);
        return redirect('/');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Task::where('id', $id)->update(['position' => $index]);
        }
        return response()->json(['success' => true]);
    }
    
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
}
