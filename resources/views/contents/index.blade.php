<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Lista de Conteúdos</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botão "Adicionar Novo Conteúdo" com novo estilo --}}
    <a href="{{ route('contents.create') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded font-semibold mb-4 hover:bg-sky-500/50 transition-colors duration-200">Adicionar Novo Conteúdo</a>

    @if($contents->isEmpty())
        <p>Nenhum conteúdo cadastrado.</p>
    @else
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-50">
                    {{-- Coluna para o checkbox mestre --}}
                    <th class="px-6 py-4 text-left">
                        <input type="checkbox" id="selectAllCheckbox" class="form-checkbox h-4 w-4 text-blue-600 rounded" onclick="toggleAllCheckboxes()">
                    </th>
                    <th class="px-6 py-4 text-left text-gray-600 font-semibold">Título</th>
                    {{-- Mantido o nome da coluna "Tipo" --}}
                    <th class="px-6 py-4 text-left text-gray-600 font-semibold">Tipo</th>
                    <th class="px-6 py-4 text-left text-gray-600 font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150">
                        {{-- Checkbox para cada linha --}}
                        <td class="px-6 py-4">
                            <input type="checkbox" class="row-checkbox form-checkbox h-4 w-4 text-blue-600 rounded">
                        </td>
                        <td class="px-6 py-4 flex items-center">
                            {{-- Ícone genérico para o título --}}
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0015.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            {{ $content->title }}
                        </td>
                        <td class="px-6 py-4">
                                <span class="capitalize text-gray-600">{{ $content->type }}</span>
                        </td>
                        <td class="px-6 py-4 relative">
                            <div class="relative inline-block text-left">
                                {{-- Botão de ações com ícone de reticências --}}
                                <button type="button" class="inline-flex items-center justify-center p-1 rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu-button-{{ $content->id }}" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown('dropdown-menu-{{ $content->id }}')">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>

                                {{-- Menu dropdown de ações --}}
                                <div class="absolute right-0 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden z-10" id="dropdown-menu-{{ $content->id }}" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button-{{ $content->id }}">
                                    <div class="py-1" role="none">
                                        {{-- Editar --}}
                                        <a href="{{ route('contents.edit', $content->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Editar
                                        </a>
                
                                        {{-- Definir para Tela --}}
                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-1.25-3M15 10V5a2 2 0 00-2-2H7a2 2 0 00-2 2v5m7 0h2a2 2 0 012 2v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4a2 2 0 012-2h2"></path></svg>
                                            Definir para Tela
                                        </a>


                                        {{-- Detalhes do Item --}}
                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Detalhes do Item
                                        </a>
                                        {{-- Excluir --}}
                                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este conteúdo?');" role="none">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100 hover:text-red-900 focus:outline-none" role="menuitem">
                                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        function toggleAllCheckboxes() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            // Fecha todos os outros dropdowns abertos antes de abrir o atual
            document.querySelectorAll('[id^="dropdown-menu-"]').forEach(otherDropdown => {
                if (otherDropdown.id !== dropdownId && !otherDropdown.classList.contains('hidden')) {
                    otherDropdown.classList.add('hidden');
                }
            });
            dropdown.classList.toggle('hidden');
        }

        // Fecha os dropdowns ao clicar fora
        window.addEventListener('click', function(event) {
            // Verifica se o clique não foi em um botão de menu de opções nem dentro de um dropdown
            if (!event.target.closest('[id^="options-menu-button-"]') && !event.target.closest('[id^="dropdown-menu-"]')) {
                const dropdowns = document.querySelectorAll('[id^="dropdown-menu-"]');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</x-app-layout>