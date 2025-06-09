<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-900">Editar Conteúdo</h1>

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

        <form action="{{ route('contents.update', $content->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-lg font-semibold mb-2 text-gray-700">Título:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="type" class="block text-lg font-semibold mb-2 text-gray-700">Tipo de Conteúdo:</label>
                <select name="type" id="type" required onchange="handleTypeChange(event)"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="image" {{ old('type', $content->type) == 'image' ? 'selected' : '' }}>Imagem</option>
                    <option value="video" {{ old('type', $content->type) == 'video' ? 'selected' : '' }}>Vídeo</option>
                    <option value="text" {{ old('type', $content->type) == 'text' ? 'selected' : '' }}>Texto</option>
                </select>
            </div>

            <div id="file-input-container" class="{{ in_array(old('type', $content->type), ['image','video']) ? '' : 'hidden' }}">
                <label for="file" class="block text-lg font-semibold mb-2 text-gray-700">Arquivo:</label>
                @if($content->path)
                <p class="mb-2 text-sm text-gray-600">
                    Arquivo atual:
                    @if($content->type == 'image')
                    <a href="{{ asset('storage/' . $content->path) }}" target="_blank">
                        <img src="{{ asset('storage/' . $content->path) }}" alt="Imagem atual" class="h-20 w-20 object-cover rounded shadow border border-gray-200">
                    </a>


                    @elseif($content->type == 'video')
                    <video src="{{ asset('storage/' . $content->path) }}" controls class="max-h-40"></video>
                    @endif
                </p>
                @endif
                <input type="file" name="file" id="file" accept="image/*,video/*"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div id="text-input-container" class="{{ old('type', $content->type) == 'text' ? '' : 'hidden' }}">
                <label for="text" class="block text-lg font-semibold mb-2 text-gray-700">Texto:</label>
                <textarea name="text" id="text" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('text', $content->text) }}</textarea>
            </div>

            <div>
                <label for="start_at" class="block text-lg font-semibold mb-2 text-gray-700">Início do Agendamento (opcional):</label>
                <input type="datetime-local" name="start_at" id="start_at"
                    value="{{ old('start_at', $content->start_at ? $content->start_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="end_at" class="block text-lg font-semibold mb-2 text-gray-700">Fim do Agendamento (opcional):</label>
                <input type="datetime-local" name="end_at" id="end_at"
                    value="{{ old('end_at', $content->end_at ? $content->end_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Atualizar Conteúdo
                </button>
            </div>
        </form>
    </div>

    <script>
        function handleTypeChange(e) {
            const fileContainer = document.getElementById('file-input-container');
            const textContainer = document.getElementById('text-input-container');
            const val = e.target.value;

            if (val === 'image' || val === 'video') {
                fileContainer.classList.remove('hidden');
                textContainer.classList.add('hidden');
            } else if (val === 'text') {
                fileContainer.classList.add('hidden');
                textContainer.classList.remove('hidden');
            } else {
                fileContainer.classList.add('hidden');
                textContainer.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const selectType = document.getElementById('type');
            handleTypeChange({
                target: selectType
            });
        });
    </script>
</x-app-layout>