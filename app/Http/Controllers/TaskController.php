<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'board_id' => ['required', 'integer', 'exists:boards,id']
        ]);

        Task::create($data);

        return redirect()->back()->with('success', 'Задача создана!');
    }
}
