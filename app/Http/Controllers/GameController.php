<?php

namespace App\Http\Controllers;

use App\Enums\Color;
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
//            dump('empty');
//            dump(Auth::id());
            $items = [];

            for ($i = 0; $i < 6; $i++) {
                for ($j = 0; $j < 2; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $item = [
                            'color' => Color::cases()[array_rand(Color::cases())]->value,
                            'x' => $i,
                            'y' => $j,
                        ];
                        $items[] = $item;
                    }
                }
            }
            $data = [
                'status' => Status::New,
                'user_id' => Auth::id(),
                'data' => json_encode($items),
            ];
//            dump($data);
//            exit;
            $game = Game::create($data);
//            dump($game->id);
//            exit;
            return redirect()->route('game', ['id' => $game->id]);
        } elseif (empty($game)) {
            return redirect('');
            exit;
//        } else {
//            dump($id);
//            dump($game);
        }

        return view('game', [
            'data' => $game->data,
        ]);
    }
}
