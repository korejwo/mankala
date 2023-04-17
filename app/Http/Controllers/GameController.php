<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\Status;
use App\Models\Game;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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

    /**
     * @param int|null $id
     * @return View|Factory|Redirector|RedirectResponse|Application
     * @throws Exception
     */
    public function game(int $id = null): View|Factory|Redirector|RedirectResponse|Application
    {
        $game = Game::find($id);

        if (!$id) {
            $data = [
                'status' => Status::New,
                'user_id' => Auth::id(),
                'token' => $this->generateRandomString(),
                'data' => json_encode($this->generateItems()),
            ];
            $game = Game::create($data);

            return redirect()->route('game', ['id' => $game->id]);
        } elseif (empty($game)) {
            return redirect('');
        }

        return view('game', [
            'data' => $game->data,
            'token' => $game->token,
            'id' => $game->id,
        ]);
    }

    /**
     * @param int $id
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    public function reRock(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        $game = Game::find($id);

        if (empty($game)) {
            return redirect('');
        }

        $game->data = json_encode($this->generateItems());
        $game->save();

        return redirect()->route('game', ['id' => $game->id]);
    }

    /**
     * @return array
     */
    private function generateItems(): array
    {
        $items = [];

        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 2; $j++) {
                for ($k = 0; $k < 4; $k++) {
                    $item = [
                        'color' => Color::cases()[array_rand(Color::cases())]->value,
                        'x' => 142 + $i * 90 + (($k % 2) * 20),
                        'y' => 72 + $j * 120 + (floor($k / 2) * 20),
                    ];
                    $items[] = $item;
                }
            }
        }

        return $items;
    }

    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    private function generateRandomString(int $length = 16): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
