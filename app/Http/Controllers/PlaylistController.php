<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Content;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the playlists.
     */
    public function index()
    {
        $playlists = Playlist::paginate(10);
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new playlist.
     */
    public function create()
    {
        // Se quiser mostrar todos os conteúdos, use:
        $contents = Content::select('id', 'type', 'path', 'text', 'duration')->get();
        return view('player.preview', compact('contents'));
    }

    /**
     * Store a newly created playlist in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'contents' => 'required|array',
            'contents.*' => 'exists:contents,id',
        ]);

        $playlist = Playlist::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        // Salva durations personalizados na pivô
        $syncData = [];
        foreach ($request->contents as $contentId) {
            $duration = $request->duration[$contentId] ?? 10;
            $syncData[$contentId] = ['duration' => $duration];
        }
        $playlist->contents()->sync($syncData);

        return redirect()->route('playlists.index')->with('success', 'Playlist criada com sucesso!');
    }

     public function preview(Playlist $playlist)
    {
        // Busca os conteúdos da playlist com a duração personalizada da pivô
        $contents = $playlist->contents()->get()->map(function ($content) {
            $content->duration = $content->pivot->duration ?? $content->duration ?? 10;
            return $content;
        });
        return view('player.preview', compact('contents'));
    }

    /**
     * Show the form for editing the specified playlist.
     */
    public function edit(Playlist $playlist)
    {
        $contents = Content::all();
        $selectedContents = $playlist->contents()->pluck('content_id')->toArray(); // assuming pivot table 'playlist_content'
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
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'contents' => 'required|array',
            'contents.*' => 'exists:contents,id',
        ]);

        $playlist->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        $syncData = [];

        if ($request->has('contents')) {
            foreach ($request->contents as $contentId) {
                // Verifica se veio um duration para esse conteúdo
                $duration = $request->durations[$contentId] ?? 10;
                $syncData[$contentId] = ['duration' => $duration];
            }

            $playlist->contents()->sync($syncData);
        } else {
            // Se nenhum conteúdo for selecionado
            $playlist->contents()->detach();
        }
        return redirect()->route('playlists.index')->with('success', 'Playlist atualizada com sucesso!');
    }

    /**
     * Remove the specified playlist from storage.
     */
    public function destroy(Playlist $playlist)
    {
        // Optionally detach related contents
        $playlist->contents()->detach();
        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist excluída com sucesso!');
    }
}
