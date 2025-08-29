<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Content::query();
        if ($type && in_array($type, ['image', 'video', 'text'])) {
            $query->where('type', $type);
        }
        $contents = $query->paginate(15);
        return view('contents.index', compact('contents', 'type'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:image,video,text',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:51200',
            'text' => 'nullable|string',
            'duration' => 'nullable|integer|min:1', // Validação para duração
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
        ]);

        $content = new Content();
        $content->title = $request->input('title');
        $content->type = $request->input('type');

        if ($request->hasFile('file')) {
            $content->path = $request->file('file')->store('contents', 'public');
        }

        if ($request->input('type') === 'text') {
            $content->text = $request->input('text');
        }

        $content->save();

        return redirect()->route('contents.index')->with('success', 'Conteúdo criado com sucesso!');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'required|in:image,video,text',
            'file'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:51200',
            'text'      => 'nullable|string|required_if:type,text',
            'duration'  => 'nullable|integer|min:1', // Validação para duração
            'start_at'  => 'nullable|date',
            'end_at'    => 'nullable|date|after_or_equal:start_at',
            
        ]);

        $content->title = $request->title;
        $content->type = $request->type;
        $content->duration = $request->duration; // Atualizando duração

        if (in_array($request->type, ['image', 'video'])) {
            if ($request->hasFile('file')) {
                // Deletar arquivo antigo
                if ($content->path && Storage::disk('public')->exists($content->path)) {
                    Storage::disk('public')->delete($content->path);
                }
                $content->path = $request->file('file')->store('contents', 'public');
                $content->thumbnail = null; // Sem geração de thumbnail aqui
            }
        } elseif ($request->type === 'text') {
            $content->text = $request->text;
            // Limpar arquivos se mudar para texto
            if ($content->path) Storage::disk('public')->delete($content->path);
            $content->path = null;
            $content->thumbnail = null;
        }

        $content->save();

        return redirect()->route('contents.index')->with('success', 'Conteúdo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        if ($content->path && Storage::disk('public')->exists($content->path)) {
            Storage::disk('public')->delete($content->path);
        }
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Conteúdo excluído com sucesso!');
    }

    public function player()
    {
        $contents = Content::all();
        return view('player', compact('contents'));
    }
}