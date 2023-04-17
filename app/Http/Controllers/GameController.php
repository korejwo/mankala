<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class GameController extends Controller
{
    public function callAction($method, $parameters)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        return parent::callAction($method, $parameters);
    }

    public function showAll(): View
    {
        /** @var Game[] $games */
        $games = Game::all();
//        dump($games);
//        dump($games->toArray());
        $finished = array_values(array_filter($games->toArray(), function ($game) {
            return $game['status'] == Status::Finished;
        }));
//        dump($finished);

        $opened = [];

        foreach ($games as $game) {
            if ($game->status == Status::New) {
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

    public function game(int $id = null)
    {
//        $game = Game::firstWhere('id', $id);
        $game = Game::find($id);
//        $game = Game::where('id', '=', $id)->get();
//        dump($game);
//        dump(count($game));
//        dump(empty($game));

        if (!$id) {
            dump('empty');
            dump(Auth::id());
            $data = [
                'status' => Status::New,
                'user_id' => Auth::id(),
            ];
            dump($data);
//            exit;
            Game::create($data);
        } elseif (empty($game)) {
            return redirect('');
            exit;
        } else {
            dump($id);
            dump($game);
            dump($game->user);
        }

        return view('game', [
        ]);
    }
}
