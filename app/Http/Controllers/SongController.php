<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::get();
        return [
            "status" => 1,
            "data" => $songs
        ];
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'lyrics' => 'required',
        ]);


        $found = Song::where('title', $request->title)->where('artist', $request->artist)->count();
        if (!$found) {
            $song = Song::create($request->all());
            return [
                "status" => 1,
                "data" => $song,
                "message" => "Song added successfully",
                "success" => true
            ];
        } else {
            return [
                "status" => 0,
                "message" => "Song already exists",
                "success" => false
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return [
            "status" => 1,
            "data" => $song
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required',
        ]);


        $found = Song::where('title', $request->title)->where('artist', $request->artist)->count();
        if (!$found) {
            $song->update($request->all());
            return [
                "status" => 1,
                "data" => $song,
                "message" => "Song updated successfully",
                "success" => true
            ];
        } else {
            return [
                "status" => 0,
                "message" => "Song already exists",
                "success" => false
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return [
            "status" => 1,
            "data" => $song,
            "msg" => "Song deleted successfully"
        ];
    }
}
