<?php

namespace App\Http\Controllers\devControllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
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
}
