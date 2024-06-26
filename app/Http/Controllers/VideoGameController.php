<?php

namespace App\Http\Controllers;

use App\Models\VideoGame;
use Illuminate\Http\Request;

class VideoGameController extends Controller
{
    public function index()
    {
        $videoGames = VideoGame::all();
        return view('videoGames.index', compact('videoGames'));
    }

    public function create()
    {
        return view('videoGames.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'developer' => 'required',
            'release_date' => 'required|date',
        ]);

        VideoGame::create($request->all());

        return redirect()->route('video-games.index')
            ->with('success', 'Video game created successfully.');
    }

    public function show(VideoGame $videoGame)
    {
        return view('videoGames.show', compact('videoGame'));
    }

    public function edit(VideoGame $videoGame)
    {
        return view('videoGames.edit', compact('videoGame'));
    }

    public function update(Request $request, VideoGame $videoGame)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'developer' => 'required',
            'release_date' => 'required|date',
        ]);

        $videoGame->update($request->all());

        return redirect()->route('video-games.index')
            ->with('success', 'Video game updated successfully.');
    }

    public function destroy(VideoGame $videoGame)
    {
        $videoGame->delete();

        return redirect()->route('video-games.index')
            ->with('success', 'Video game deleted successfully.');
    }
}
