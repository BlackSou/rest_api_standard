<?php

namespace App\Http\Controllers;

use App\Play;
use App\Http\Requests\PlayRequest;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Play::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayRequest $request)
     {
         $day = Play::create($request->validated());
         return $day;
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function show(Play $play)
    {
      return $play = Play::findOrFail($play);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function update(PlayRequest $request, $id)
     {
         $play = Play::findOrFail($id);
         $play->fill($request->except(['play_id']));
         $play->save();
         return response()->json($play);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayRequest $request, $id)
     {
         $play = Play::findOrFail($id);
         if($play->delete()) return response(null, 204);
     }
}
