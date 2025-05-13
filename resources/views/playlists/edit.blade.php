<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-900">Editar Playlist</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <strong>Ops! Encontramos alguns erros:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('playlists.update', $playlist->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-lg font-semibold mb-2 text-gray-700">Nome da Playlist</label>
                <input type="text" name="name" id="name" value="{{ old('name', $playlist->name) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold mb-2 text-gray-700">Descrição (opcional)</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $playlist->description) }}</textarea>
            </div>

            <div>
                <label for="contents" class="block text-lg font-semibold mb-2 text-gray-700">Selecionar Conteúdos</label>
                <select name="contents[]" id="contents" multiple size="6"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach ($contents as $content)
                        <option value="{{ $content->id }}"
                            {{ in_array($content->id, old('contents', $selectedContents ?? [])) ? 'selected' : '' }}>
                            {{ $content->title }} ({{ ucfirst($content->type) }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-sm text-gray-500">Pressione Ctrl (Cmd no macOS) para selecionar múltiplos conteúdos.</p>
            </div>

            <div>
                <label for="start_at" class="block text-lg font-semibold mb-2 text-gray-700">Início do Agendamento (opcional):</label>
                <input type="datetime-local" name="start_at" id="start_at" 
                    value="{{ old('start_at', $playlist->start_at ? $playlist->start_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="end_at" class="block text-lg font-semibold mb-2 text-gray-700">Fim do Agendamento (opcional):</label>
                <input type="datetime-local" name="end_at" id="end_at" 
                    value="{{ old('end_at', $playlist->end_at ? $playlist->end_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Atualizar Playlist
                </button>
            </div>
        </form>
    </div>
</x-app-layout>