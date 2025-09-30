<?php

namespace App\Http\Controllers\devControllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\TableMember;
use App\Models\Task;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    function generateBoards(string $count)
    {
        Board::factory()->count($count)->create();
        return 'success';
    }

    function generateTasks(string $count){
        Task::factory()->count($count)->create();
        return 'success';
    }

    function generateUsers(string $count)
    {
        UserFactory::$password = 'userpassword';

        User::factory()->count($count)->create();
        return 'success';
    }

    function addMemberInBoard(string $boardId, string $memberId)
    {
        $board = Board::query()->find($boardId);
        $user = User::query()->find($memberId);

        $member = TableMember::create([
            'board_id' => $board->id,
            'user_id' => $user->id,
            'access_level' => 'editor'
        ]);

        return 'success';
    }
}
