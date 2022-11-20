<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return response()->json([
            'status' => 200,
            'data' => $games,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        $request->validate([
            'player_a' =>   'required|integer|max:255',
            'player_b' =>  'required|integer|max:255',
            'player_a_point' =>   'required|integer|max:255',
            'player_b_point' => 'required|integer|max:255',
        ]);

        $data = $request->all();
        $store_game = Game::create($data);
        return new GameResource($store_game);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game, $id)
    {
        $game = Game::find($id);
        return response()->json([
            'status' => 200,
            'data' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGameRequest  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game, $id)
    {
        $tournament = Auth::tournament();
        $game = $tournament->tournament()->find($id)->update($request->all());
        if (!$game) {
            return response()->json([
                'status' => 500,
                'message' => 'Update failed'
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Update successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, $id)
    {
        $tournament = Auth::tournament();
        $tournament->game()->find($id)->delete();

        return response()->json([
            'status' => 204,
            'message' => 'Delete successful'
        ]);
    }
}
