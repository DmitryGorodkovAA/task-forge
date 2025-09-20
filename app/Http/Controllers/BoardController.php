<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoardController extends Controller
{
    function index(string $id)
    {
        $boards = Board::query()->get();
        $tasks = Task::query()->where('board_id', $id)->get();
        return  Inertia::render('Board/index', ['boards' => $boards, 'tasks' => $tasks]);
    }
}
