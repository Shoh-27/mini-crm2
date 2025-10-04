<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Lead;
use App\Models\Deal;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['user', 'taskable'])->orderBy('status')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all();
        $leads = Lead::all();
        $deals = Deal::all();
        return view('tasks.create', compact('users', 'leads', 'deals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'deadline' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
            'taskable_type' => 'required|string',
            'taskable_id' => 'required|integer',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
