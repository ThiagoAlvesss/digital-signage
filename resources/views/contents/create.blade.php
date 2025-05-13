<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md mt-6">
        <h1 class="text-2xl font-bold mb-6">Adicionar Novo Conteúdo</h1>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <strong>Ops! Algo deu errado:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block font-semibold mb-1">Título:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="type" class="block font-semibold mb-1">Tipo de Conteúdo:</label>
                <select name="type" id="type" required onchange="handleTypeChange(event)"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="" disabled selected>Selecione o tipo</option>
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Imagem</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Vídeo</option>
                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Texto</option>
                </select>
            </div>

            <div id="file-input-container" class="hidden">
                <label for="file" class="block font-semibold mb-1">Arquivo:</label>
                <input type="file" name="file" id="file" accept="image/*,video/*"
                    class="w-full" />
            </div>

            <div id="text-input-container" class="hidden">
                <label for="text" class="block font-semibold mb-1">Texto:</label>
                <textarea name="text" id="text" rows="4"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('text') }}</textarea>
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded font-semibold hover:bg-indigo-700 transition w-full">
                    Salvar
                </button>
            </div>
            <div>
                <label for="start_at" class="block font-semibold mb-1">Início do Agendamento (opcional):</label>
                <input type="datetime-local" name="start_at" id="start_at" value="{{ old('start_at', isset($content) ? $content->start_at ? $content->start_at->format('Y-m-d\TH:i') : '' : '') }}" class="border rounded p-2 w-full" />
            </div>

            <div>
                <label for="end_at" class="block font-semibold mb-1">Fim do Agendamento (opcional):</label>
                <input type="datetime-local" name="end_at" id="end_at" value="{{ old('end_at', isset($content) ? $content->end_at ? $content->end_at->format('Y-m-d\TH:i') : '' : '') }}" class="border rounded p-2 w-full" />
            </div>
        </form>
    </div>

    <script>
        function handleTypeChange(e) {
            const fileInputContainer = document.getElementById('file-input-container');
            const textInputContainer = document.getElementById('text-input-container');
            const selectedType = e.target.value;

            if (selectedType === 'image' || selectedType === 'video') {
                fileInputContainer.classList.remove('hidden');
                textInputContainer.classList.add('hidden');
            } else if (selectedType === 'text') {
                fileInputContainer.classList.add('hidden');
                textInputContainer.classList.remove('hidden');
            } else {
                fileInputContainer.classList.add('hidden');
                textInputContainer.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            if (typeSelect.value) {
                handleTypeChange({
                    target: typeSelect
                });
            }
        });
    </script>
</x-app-layout>