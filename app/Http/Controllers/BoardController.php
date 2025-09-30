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
        return  Inertia::render('Board/index', ['boards' => $boards, 'tasks' => $tasks, 'selectedBoard' => $selectedBoard]);
    }

    function addOrChangeAccessLevel(string $userId, $boardId, $accessLevel){
        $user = User::findOrFail($userId);
        $board = Board::findOrFail($boardId);

        return 'всё хорошо :)';
    }
}
