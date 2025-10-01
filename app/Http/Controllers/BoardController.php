<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoardController extends Controller
{
    function index(string $id)
    {
        $boards = Board::query()->get();
        $selectedBoard = Board::query()->find($id);
        $tasks = Task::query()->where('board_id', $id)->get();
        return Inertia::render('Board/index', ['boards' => $boards, 'tasks' => $tasks, 'selectedBoard' => $selectedBoard]);
    }

    function addOrChangeAccessLevel(string $userId, $boardId, $accessLevel)
    {
        $user = User::findOrFail($userId);
        $board = Board::findOrFail($boardId);

        return 'всё хорошо :)';
    }

    function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required | string | max:255',
            'description' => 'required | string | max:255',
            'color' => 'required | string | max:255',
        ]);

        $data['user_id'] = 1;

        Board::create($data);

        return redirect()->back();
    }
}
