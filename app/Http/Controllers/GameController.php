<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function showAll(): View
    {
        /** @var Game[] $games */
        $games = Game::all();
//        dump($games);
//        dump($games->toArray());
        $finished = array_values(array_filter($games->toArray(), function ($game) {
            return $game['finished'];
        }));
//        dump($finished);

        $opened = [];

        foreach ($games as $game) {
            if ($game->finished) {
                continue;
            }

            $opened[] = $game;
        }

//        dump($opened);

        return view('games', [
            'finished' => $finished,
            'opened' => $opened,
        ]);
    }
}
