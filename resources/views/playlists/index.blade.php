<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <header class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Playlists</h1>
            <a href="{{ route('playlists.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg shadow-lg transition duration-300 font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nova Playlist
            </a>
        </header>

        @if(session('success'))
            <div class="mb-6 px-6 py-4 bg-green-100 border border-green-400 text-green-700 rounded-md shadow-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if($playlists->isEmpty())
            <div class="mt-12 text-center text-gray-500 text-xl font-semibold">
                Nenhuma playlist cadastrada ainda.<br />
                Clique no botão "Nova Playlist" para começar a criar.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($playlists as $playlist)
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg text-white p-6 flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
                        <div>
                            <h2 class="text-2xl font-bold truncate">{{ $playlist->name }}</h2>
                            <p class="mt-2 text-indigo-200 leading-relaxed min-h-[3rem]">
                                {{ $playlist->description ?? 'Sem descrição' }}
                            </p>
                        </div>
                        <div class="mt-6 flex space-x-3">
                            <a href="{{ route('playlist.preview', $playlist->id) }}" target="_blank" class="flex-1 bg-green-500 hover:bg-green-600 rounded-lg py-2 text-center font-semibold shadow-md transition-colors">
                                Visualizar
                            </a>
                            <a href="{{ route('playlists.edit', $playlist->id) }}" class="flex-1 bg-yellow-400 hover:bg-yellow-500 rounded-lg py-2 text-center font-semibold shadow-md transition-colors text-gray-900">
                                Editar
                            </a>
                            <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta playlist?');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 rounded-lg py-2 font-semibold shadow-md transition-colors">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>