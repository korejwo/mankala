<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiGameController extends Controller
{
    public function callAction($method, $parameters)
    {
        if (!Auth::check()) {
            http_response_code(401);
            exit;
        }

        return parent::callAction($method, $parameters);
    }

    public function get($id)
    {
        $game = Game::find($id);

        if (!$game) {
            http_response_code(403);
            exit;
        }

        return Game::find($id);
    }
}
