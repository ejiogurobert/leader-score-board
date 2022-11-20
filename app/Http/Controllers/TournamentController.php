<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TournamentResource;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::all();
        return response()->json([
            'status' => 200,
            'data' => $tournaments,
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
     * @param  \App\Http\Requests\StoreTournamentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $store_tournament = $user->tournament()->create($data);
        return new TournamentResource($store_tournament);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament, $id)
    {
        $tournament = Tournament::find($id);
        return response()->json([
            'status' => 200,
            'data' => $tournament,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentRequest  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentRequest $request, $id)
    {
        // $user = Auth::user();
        // $tournament = $user->tournament()->find($id)->update($request->all());
        $tournament = Tournament::find($id);
        if (!$tournament) {
            return response()->json([
                'status' => 500,
                'message' => 'Update failed'
            ]);
        } else {
            $data = $request->all();
            $tournament_update = $tournament->update($data);
            if ($tournament_update) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Update successful'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Update not successful'
                ]);
            }
            // return response()->json([
            //     'status' => 200,
            //     'message' => 'Update successful'
            // ]);
        }

        // return response()->json([
        //     'status' => 200,
        //     'message' => 'Update successful'
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $user->tournament()->find($id)->delete();

        return response()->json([
            'status' => 204,
            'message' => 'Delete successful'
        ]);
    }
}
