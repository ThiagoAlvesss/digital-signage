<x-app-layout>
    <div class="max-w-5xl mx-auto pt-16 pb-20 px-8 bg-white rounded-lg shadow-lg min-h-screen">
        <h1 class="text-[3rem] font-extrabold text-gray-900 mb-10">Criar / Editar Playlist</h1>
        <form action="{{ isset($playlist) ? route('playlists.update', $playlist->id) : route('playlists.store') }}" method="POST" class="space-y-8">
            @csrf
            @if(isset($playlist))
                @method('PUT')
            @endif

            <!-- Nome -->
            <section class="space-y-2">
                <label for="name" class="block text-lg font-semibold text-gray-700">Nome da Playlist</label>
                <input type="text" name="name" id="name" value="{{ old('name', $playlist->name ?? '') }}" required
                    class="w-full rounded-xl border border-gray-300 px-5 py-3 text-lg text-gray-900 placeholder-gray-400 focus:border-black focus:ring-0" />
            </section>

            <!-- Descrição -->
            <section class="space-y-2">
                <label for="description" class="block text-lg font-semibold text-gray-700">Descrição (opcional)</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-xl border border-gray-300 px-5 py-3 text-lg text-gray-900 placeholder-gray-400 resize-none focus:border-black focus:ring-0">{{ old('description', $playlist->description ?? '') }}</textarea>
            </section>

            <!-- Conteúdos com Duração Individual -->
            <section class="space-y-4">
                <label class="block text-lg font-semibold text-gray-700">Selecionar Conteúdos e Duração de Exibição</label>
                
                @foreach($contents as $content)
                    @php
                        $isChecked = in_array($content->id, old('contents', $selectedContents ?? []));
                        $pivotDuration = optional($playlist->contents->where('id', $content->id)->first())->pivot->duration ?? 10;
                        $durationValue = old('durations.' . $content->id, $pivotDuration);
                    @endphp

                    <div class="flex items-center space-x-4 border p-3 rounded">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="contents[]" value="{{ $content->id }}" {{ $isChecked ? 'checked' : '' }}>
                            <span>{{ $content->title }} ({{ ucfirst($content->type) }})</span>
                        </label>

                        <div class="flex items-center space-x-2">
                            <label for="durations_{{ $content->id }}">Duração (seg):</label>
                            <input type="number" min="1" name="durations[{{ $content->id }}]" id="durations_{{ $content->id }}" value="{{ $durationValue }}"
                                class="w-20 rounded border-gray-300 px-2 py-1 text-sm text-gray-900">
                        </div>
                    </div>
                @endforeach
            </section>

            <!-- Agendamento -->
            <section class="grid grid-cols-2 gap-6">
                <div>
                    <label for="start_at" class="block text-lg font-semibold text-gray-700">Início do Agendamento (opcional)</label>
                    <input type="datetime-local" name="start_at" id="start_at"
                        value="{{ old('start_at', isset($playlist->start_at) ? $playlist->start_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-xl border border-gray-300 px-5 py-3 text-lg text-gray-900 placeholder-gray-400 focus:border-black focus:ring-0" />
                </div>
                <div>
                    <label for="end_at" class="block text-lg font-semibold text-gray-700">Fim do Agendamento (opcional)</label>
                    <input type="datetime-local" name="end_at" id="end_at"
                        value="{{ old('end_at', isset($playlist->end_at) ? $playlist->end_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-xl border border-gray-300 px-5 py-3 text-lg text-gray-900 placeholder-gray-400 focus:border-black focus:ring-0" />
                </div>
            </section>

            <!-- Botão -->
            <button type="submit"
                class="w-full rounded-xl bg-black text-white py-4 text-2xl font-extrabold hover:bg-gray-900 transition-colors duration-300">
                {{ isset($playlist) ? 'Atualizar Playlist' : 'Criar Playlist' }}
            </button>
        </form>
    </div>
</x-app-layout>
