<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the contents.
     */
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new content.
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created content in storage.
     */
    public function store(Request $request)
{
    // Validação dos dados
    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:2048', // Ajuste conforme necessário
        'text' => 'nullable|string',
        'start_at' => 'nullable|date',
        'end_at' => 'nullable|date|after_or_equal:start_at',

    ]);

    // Criação do novo conteúdo
    $content = new Content();
    $content->title = $request->input('title');
    $content->type = $request->input('type');

    // Verifica se um arquivo foi enviado
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('uploads', 'public'); // Armazena o arquivo
        $content->path = $path; // Supondo que você tenha uma coluna file_path na tabela
    }

    // Verifica se o tipo é texto e armazena o texto
    if ($request->input('type') === 'text') {
        $content->text = $request->input('text');
    }

    // Salva o conteúdo no banco de dados
    $content->save();

    // Redireciona com uma mensagem de sucesso
    return redirect()->route('contents.index')->with('success', 'Conteúdo criado com sucesso!');
}


    /**
     * Show the form for editing the specified content.
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('contents.edit', compact('content'));
    }

    /**
     * Update the specified content in storage.
     */
    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video,text',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:20480',
            'text' => 'required_if:type,text|string',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',

        ]);

        $content->title = $request->title;
        $content->type = $request->type;

        if (in_array($request->type, ['image', 'video'])) {
            if ($request->hasFile('file')) {
                if ($content->path && Storage::disk('public')->exists($content->path)) {
                    Storage::disk('public')->delete($content->path);
                }
                $path = $request->file('file')->store('contents', 'public');
                $content->path = $path;
                $content->text = null;
            }
        } elseif ($request->type === 'text') {
            $content->text = $request->text;
            if ($content->path) {
                if (Storage::disk('public')->exists($content->path)) {
                    Storage::disk('public')->delete($content->path);
                }
                $content->path = null;
            }
        }

        $content->save();

        return redirect()->route('contents.index')->with('success', 'Conteúdo atualizado com sucesso!');
    }

    /**
     * Remove the specified content from storage.
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        if ($content->path && Storage::disk('public')->exists($content->path)) {
            Storage::disk('public')->delete($content->path);
        }
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Conteúdo excluído com sucesso!');
    }

    /**
     * Display the player view with all contents.
     */
    public function player()
    {
        $contents = Content::all();
        return view('player', compact('contents'));
    }
}





