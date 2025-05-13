<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Content;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of playlists.
     */
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new playlist.
     */
    public function create()
    {
        $contents = Content::all(); // para selecionar conteúdos na playlist
        return view('playlists.create', compact('contents'));
    }

    /**
     * Store a newly created playlist in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contents' => 'array',
            'contents.*' => 'exists:contents,id',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',

        ]);

        $playlist = Playlist::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('contents')) {
            $playlist->contents()->sync($request->contents);
        }

        return redirect()->route('playlists.index')->with('success', 'Playlist criada com sucesso!');
    }

    /**
     * Show the form for editing the specified playlist.
     */
    public function edit(Playlist $playlist)
    {
        $contents = Content::all();
        $selectedContents = $playlist->contents->pluck('id')->toArray();

        return view('playlists.edit', compact('playlist', 'contents', 'selectedContents'));
    }

    /**
     * Update the specified playlist in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contents' => 'array',
            'contents.*' => 'exists:contents,id',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',

        ]);

        $playlist->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('contents')) {
            $playlist->contents()->sync($request->contents);
        } else {
            $playlist->contents()->detach();
        }

        return redirect()->route('playlists.index')->with('success', 'Playlist atualizada com sucesso!');
    }

    /**
     * Remove the specified playlist from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->contents()->detach();
        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist excluída com sucesso!');
    }

    /**
     * Show the contents of a playlist to playback.
     */
    public function show(Playlist $playlist)
    {
        $contents = $playlist->contents()->get();

        return view('player', compact('contents'));
    }
}

