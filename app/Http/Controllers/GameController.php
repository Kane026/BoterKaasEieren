<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::query()
            ->where('player_x_id', Auth::id())
            ->orWhere('player_o_id', Auth::id())
            ->latest()
            ->get();

        return view('game.index', compact('games'));
    }

    public function create()
    {
        $players = User::query()->where('id', '!=', Auth::id())->orderBy('name')->get();
        

        return view('game.create', compact('players'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opponent_id' => ['required', 'exists:users,id'],
        ]);

        $game = Game::create([
            'player_x_id' => Auth::id(),
            'player_o_id' => $validated['opponent_id'],
            'status' => 'active',
            'current_turn' => 'X',
            'started_at' => now(),
        ]);

        return redirect()->route('game.show', $game);
    }

    public function show(Game $game)
    {
        $game->load([
            'playerX',
            'playerO',
            'winner',
            'rounds.player',
        ]);

         $bord = $this->createGameField(3, 3);

        foreach ($game->rounds as $round) {
            $bord[$round->row][$round->column] = $round->symbol;
        }

        return view('game.show', compact('game', 'bord'));
    }

    public function storeMove(Request $request, Game $game){
            $game->rounds()->create([
            'player_id' => Auth::id(),
            'symbol'    => $game->current_turn,
            'row'       => $request->row,
            'column'    => $request->col,
            'turn_number' => $game->rounds()->count() + 1,
        ]);

         $game->update([
        'current_turn' => $game->current_turn === 'X' ? 'O' : 'X',
    ]);

    return redirect()->route('game.show', $game);
}

    

    public function getGameField()
    {
        $rij = Game::select('rij')->get();
        $kolom = Game::select('kolom')->get();
        return response()->json(['rij' => $rij, 'kolom' => $kolom]);
    }
    public function createGameField($rows, $columns)
    {
        $gameField = [];
        for ($rij = 0; $rij < $rows; $rij++) {
            for ($kolom = 0; $kolom < $columns; $kolom++) {
                $gameField[$rij][$kolom] = null;
            }
        }
        return $gameField;
    }

}