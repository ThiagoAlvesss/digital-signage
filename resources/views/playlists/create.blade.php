<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8 bg-white rounded-xl shadow-lg mt-10">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-900">Criar Nova Playlist</h1>

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

        <form action="{{ route('playlists.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-lg font-semibold mb-2 text-gray-700">Nome da Playlist</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold mb-2 text-gray-700">Descrição (opcional)</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="contents" class="block text-lg font-semibold mb-2 text-gray-700">Selecionar Conteúdos</label>
                <select name="contents[]" id="contents" multiple size="6"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($contents as $content)
                    <option value="{{ $content->id }}"
                        {{ (collect(old('contents'))->contains($content->id)) ? 'selected' : '' }}>
                        {{ $content->title }} ({{ ucfirst($content->type) }})
                    </option>
                    @endforeach
                </select>
                <p class="mt-1 text-sm text-gray-500">Pressione Ctrl (Cmd no macOS) para selecionar múltiplos conteúdos.</p>
            </div>
            <div>
                <label for="start_at" class="block font-semibold mb-1">Início do Agendamento (opcional):</label>
                <input type="datetime-local" name="start_at" id="start_at" value="{{ old('start_at', isset($content) ? $content->start_at ? $content->start_at->format('Y-m-d\TH:i') : '' : '') }}" class="border rounded p-2 w-full" />
            </div>

            <div>
                <label for="end_at" class="block font-semibold mb-1">Fim do Agendamento (opcional):</label>
                <input type="datetime-local" name="end_at" id="end_at" value="{{ old('end_at', isset($content) ? $content->end_at ? $content->end_at->format('Y-m-d\TH:i') : '' : '') }}" class="border rounded p-2 w-full" />
            </div>
            <div>
                <button type="submit"
                    class="inline-block w-full rounded-lg bg-blue-600 text-white font-semibold py-3 text-lg hover:bg-blue-700 transition">
                    Salvar Playlist
                </button>
            </div>
        </form>
    </div>
</x-app-layout>