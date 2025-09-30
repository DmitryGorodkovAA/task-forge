<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'due_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'board_id' => ['required', 'integer', 'exists:boards,id']
        ]);

        $newTask = Task::create($data);

        return redirect()->back();
    }
}
