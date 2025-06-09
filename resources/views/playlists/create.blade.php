<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-100 min-h-screen">
        {{-- Seção do Cabeçalho da Playlist --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Playlist</h1>
            <div class="flex items-center space-x-4">
                <button class="bg-orange-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-orange-600 transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Upload Media</span>
                </button>
                <span class="text-gray-600 text-sm">Total duration: 0:00:52</span> {{-- Exemplo de duração total --}}
            </div>
        </div>

        {{-- Seção de Itens da Playlist (Horizontal Scroll) --}}
        <div class="bg-white p-4 rounded-lg shadow-md mb-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
            <div class="inline-flex items-center space-x-4 pb-2">
                @php
                    // Dados de exemplo para itens da playlist.
                    // Em um aplicativo real, isso viria de uma variável Blade como $playlistItems
                    $playlistItems = [
                        ['url' => 'https://placehold.co/100x100/E0E0E0/333333?text=Item+1', 'duration' => '5"', 'title' => 'Sample Coupons Video'],
                        ['url' => 'https://placehold.co/100x100/D0D0D0/333333?text=Item+2', 'duration' => '47"', 'title' => 'Another Media'],
                        ['url' => 'https://placehold.co/100x100/C0C0C0/333333?text=Item+3', 'duration' => '12"', 'title' => 'Third Item'],
                        ['url' => 'https://placehold.co/100x100/B0B0B0/333333?text=Item+4', 'duration' => '30"', 'title' => 'Fourth Item'],
                        ['url' => 'https://placehold.co/100x100/A0A0A0/333333?text=Item+5', 'duration' => '8"', 'title' => 'Fifth Item'],
                        ['url' => 'https://placehold.co/100x100/909090/333333?text=Item+6', 'duration' => '25"', 'title' => 'Sixth Item'],
                        ['url' => 'https://placehold.co/100x100/808080/333333?text=Item+7', 'duration' => '15"', 'title' => 'Seventh Item'],
                        ['url' => 'https://placehold.co/100x100/707070/333333?text=Item+8', 'duration' => '40"', 'title' => 'Eighth Item'],
                        ['url' => 'https://placehold.co/100x100/606060/333333?text=Item+9', 'duration' => '20"', 'title' => 'Ninth Item'],
                        ['url' => 'https://placehold.co/100x100/505050/333333?text=Item+10', 'duration' => '10"', 'title' => 'Tenth Item'],
                    ];
                @endphp

                @foreach($playlistItems as $item)
                    <div class="flex flex-col items-center p-2 border border-gray-200 rounded-md shadow-sm bg-gray-50 flex-shrink-0" style="width: 120px;">
                        <img src="{{ $item['url'] }}" alt="{{ $item['title'] }}" class="w-24 h-24 object-cover rounded-md mb-2">
                        <span class="text-xs text-gray-600 mb-2">{{ $item['duration'] }}</span>
                        <div class="flex space-x-1">
                            <button class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-sm hover:bg-gray-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </button>
                            <button class="bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center text-sm hover:bg-gray-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Seção da Biblioteca --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Library</h2>
                <div class="relative">
                    <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            {{-- Filtros da Biblioteca --}}
            <div class="flex flex-wrap gap-2 mb-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-700 transition-colors duration-200">All Media</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Images</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Videos</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Audio Assets</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Documents</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Web Pages</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Apps</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Playlists</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-yellow-600 transition-colors duration-200">Premium</button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300 transition-colors duration-200">Layouts</button>
            </div>

            {{-- Itens da Biblioteca (Grid) --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4">
                @php
                    // Dados de exemplo para itens da biblioteca.
                    // Em um aplicativo real, isso viria de uma variável Blade como $libraryItems
                    $libraryItems = [
                        ['url' => 'https://placehold.co/150x150/E0E0E0/333333?text=Media+A', 'title' => 'Media A'],
                        ['url' => 'https://placehold.co/150x150/D0D0D0/333333?text=Media+B', 'title' => 'Media B'],
                        ['url' => 'https://placehold.co/150x150/C0C0C0/333333?text=Media+C', 'title' => 'Media C'],
                        ['url' => 'https://placehold.co/150x150/B0B0B0/333333?text=Media+D', 'title' => 'Media D'],
                        ['url' => 'https://placehold.co/150x150/A0A0A0/333333?text=Media+E', 'title' => 'Media E'],
                        ['url' => 'https://placehold.co/150x150/909090/333333?text=Media+F', 'title' => 'Media F'],
                        ['url' => 'https://placehold.co/150x150/808080/333333?text=Media+G', 'title' => 'Media G'],
                        ['url' => 'https://placehold.co/150x150/707070/333333?text=Media+H', 'title' => 'Media H'],
                        ['url' => 'https://placehold.co/150x150/606060/333333?text=Media+I', 'title' => 'Media I'],
                        ['url' => 'https://placehold.co/150x150/505050/333333?text=Media+J', 'title' => 'Media J'],
                    ];
                @endphp
                
                @foreach($libraryItems as $item)
                    <div class="relative bg-gray-50 rounded-lg shadow-sm overflow-hidden group cursor-pointer hover:shadow-md transition-shadow duration-200">
                        <img src="{{ $item['url'] }}" alt="{{ $item['title'] }}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded">
                        </div>
                        <p class="p-2 text-sm text-gray-700 truncate">{{ $item['title'] }}</p>
                    </div>
                @endforeach
            </div>

            <p class="text-sm text-gray-600 mt-4">2 items</p> {{-- Exemplo de contagem de itens --}}
        </div>

        {{-- Botão "Hide playlist" --}}
        <div class="mt-6 text-center">
            <button class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md text-sm font-semibold hover:bg-gray-300 transition-colors duration-200" onclick="hidePlaylist()">Hide playlist</button>
        </div>
    </div>

    <style>
        /* Esconder a barra de rolagem, mas permitir a rolagem */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <script>
        // Função placeholder para esconder a playlist
        function hidePlaylist() {
            alert('Funcionalidade de esconder playlist seria implementada aqui!');
            // Você pode adicionar lógica para ocultar a seção da playlist ou navegar para outra página.
        }
    </script>
</x-app-layout>
