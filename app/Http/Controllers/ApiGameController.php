<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
        $game = Game::where('id', $id)->where('user_id', Auth::id())->where('status', 0)->first();

        if (empty($game)) {
            http_response_code(403);
            exit;
        }

        return $game;
    }

    public function update(int $id, Request $request)
    {
        $game = Game::where('id', $id)->where('user_id', Auth::id())->where('status', 0)->first();

        if (empty($game)) {
            http_response_code(403);
            exit;
        }

        $data = json_decode($game->data, true);
        $input = $request->all();
        $data[$input['id']]['x'] = (int) $input['x'];
        $data[$input['id']]['y'] = (int) $input['y'];
        $game->data = json_encode($data);
        $game->save();

        exit;
    }
}
