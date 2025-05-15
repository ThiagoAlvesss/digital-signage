<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Exibe a lista paginada de players com playlists associadas.
     */
    public function index()
    {
        $players = Player::with('playlist')->orderBy('name')->paginate(10);
        return view('players.index', compact('players'));
    }

    /**
     * Exibe o formulário para criar um novo player.
     */
    public function create()
    {
        $playlists = Playlist::all();
        return view('players.create', compact('playlists'));
    }

    /**
     * Armazena um novo player no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'playlist_id' => 'nullable|exists:playlists,id',
            'identifier' => 'required|string|max:255|unique:players,identifier',
        ]);

        Player::create($request->only('name', 'location', 'playlist_id', 'identifier'));

        return redirect()->route('players.index')->with('success', 'Player criado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um player existente.
     */
    public function edit(Player $player)
    {
        $playlists = Playlist::all();
        return view('players.edit', compact('player', 'playlists'));
    }

    /**
     * Atualiza um player existente no banco de dados.
     */
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'playlist_id' => 'nullable|exists:playlists,id',
            'identifier' => 'required|string|max:255|unique:players,identifier,' . $player->id,
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')->with('success', 'Player atualizado com sucesso!');
    }

    /**
     * Remove um player do banco de dados.
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player excluído com sucesso!');
    }
    public function showPlayer($identifier)
{
    $player = Player::where('identifier', $identifier)->with('playlist.contents')->firstOrFail();

    // Filtrar conteúdos ativos conforme agendamento
    $contents = $player->playlist->contents->filter(function($content) {
        $now = now();
        return (is_null($content->start_at) || $content->start_at <= $now) 
            && (is_null($content->end_at) || $content->end_at >= $now);
    });

    return view('player.show', ['contents' => $contents]);
}

public function preview($id)
    {
        $playlist = Playlist::with('contents')->findOrFail($id);
        // Filtra conteúdos ativos conforme agendamento
        $now = now();
        $contents = $playlist->contents->filter(function ($content) use ($now) {
            return (is_null($content->start_at) || $content->start_at <= $now) &&
                   (is_null($content->end_at) || $content->end_at >= $now);
        })->values();
        return view('player.preview', compact('contents'));
    }
}