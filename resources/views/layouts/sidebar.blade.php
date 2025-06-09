<aside id="sidebar" class="w-64 bg-white text-gray-700 p-4 shadow-md flex flex-col transition-all duration-300 ease-in-out">
    <div class="flex justify-end mb-4">
        {{-- Botão para minimizar/expandir o menu lateral --}}
        <button type="button"
            class="p-2 rounded-full hover:bg-gray-100 focus:outline-none"
            onclick="toggleSidebar()">
            {{-- Ícone de seta para minimizar/expandir --}}
            <svg id="minimize-icon" class="w-6 h-6 text-gray-600 transform transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7"></path> {{-- Seta apontando para a esquerda --}}
            </svg>
        </button>
    </div>

    {{-- Conteúdo principal do menu lateral --}}
    <nav class="flex-1">
        <ul>
            {{-- Novo item de menu Home --}}
            <li class="mb-2">
                <a href="/home" class="menu-item block px-6 py-2 rounded hover:bg-gray-100 flex items-center justify-start">
                    {{-- Ícone para Home (SVG) --}}
                    <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="menu-text">Home</span>
                </a>
            </li>
            {{-- Item de menu Dashboard --}}
            <li class="mb-2">
                <a href="/dashboard" class="menu-item block px-6 py-2 rounded hover:bg-gray-100 flex items-center justify-start">
                    {{-- Ícone para Dashboard (SVG) --}}
                    <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            {{-- Item de menu "Conteúdos" com submenu --}}
            <li class="mb-2">
                <button type="button"
                    class="menu-item w-full flex justify-between items-center px-6 py-2 hover:bg-gray-100 focus:outline-none rounded"
                    onclick="toggleSubMenu()">
                    {{-- Ícone de pasta para Conteúdos (SVG) --}}
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <span class="menu-text font-semibold">Conteúdos</span>
                    </div>
                    {{-- Ícone de seta para expandir/recolher (SVG) --}}
                    <svg id="submenu-icon" class="w-4 h-4 text-gray-600 transform transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Submenu de Conteúdos, inicialmente oculto --}}
                <ul id="submenu" class="ml-4 mt-2 space-y-1 hidden">
                    <li>
                        <a href="{{ route('contents.index') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700 flex items-center">
                            {{-- Ícone de pasta para Todos (SVG) --}}
                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            <span class="menu-text">Todos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contents.index', ['type' => 'image']) }}"
                            class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700 flex items-center">
                            {{-- Ícone de imagem (SVG) --}}
                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L20 20m-6-6l2-2m2 2l2-2m0 0l-2-2m-2-2l2 2M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="menu-text">Imagens</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contents.index', ['type' => 'video']) }}"
                            class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700 flex items-center">
                            {{-- Ícone de vídeo (SVG) --}}
                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 10h10a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 012-2z"></path>
                            </svg>
                            <span class="menu-text">Vídeos</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Item de menu Playlists --}}
            <li class="mb-2">
                <a href="/playlists" class="menu-item block px-6 py-2 rounded hover:bg-gray-100 flex items-center justify-start">
                    {{-- Ícone para Playlists (SVG) --}}
                    <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197 2.132A1 1 0 0110 13.055V9.945a1 1 0 011.555-.832l3.197 2.132a1 1 0 010 1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="menu-text">Playlists</span>
                </a>
            </li>

            {{-- Item de menu "Players" --}}
            <li class="mb-2">
                <a href="/players" class="menu-item block px-6 py-2 rounded hover:bg-gray-100 flex items-center justify-start">
                    {{-- Ícone para Players (SVG) --}}
                    <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-1.25-3M15 10V5a2 2 0 00-2-2H7a2 2 0 00-2 2v5m7 0h2a2 2 0 012 2v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4a2 2 0 012-2h2"></path>
                    </svg>
                    <span class="menu-text">Players</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<script>
    // Garante que o script só seja executado após o carregamento completo do DOM
    window.onload = function() {
        /**
         * Função para alternar a visibilidade do submenu 'Conteúdos' e girar o ícone de seta.
         */
        function toggleSubMenu() {
            const submenu = document.getElementById('submenu');
            const submenuIcon = document.getElementById('submenu-icon');

            // Alterna a classe 'hidden' para mostrar/ocultar o submenu
            submenu.classList.toggle('hidden');

            // Gira o ícone de seta 180 graus quando o submenu está visível
            // e volta à posição original quando oculto.
            if (!submenu.classList.contains('hidden')) {
                submenuIcon.classList.add('rotate-180');
            } else {
                submenuIcon.classList.remove('rotate-180');
            }
        }

        /**
         * Função para minimizar/expandir o menu lateral.
         */
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const minimizeIcon = document.getElementById('minimize-icon');
            const menuTexts = document.querySelectorAll('.menu-text'); // Seleciona todos os spans com texto do menu
            const mainMenuItems = document.querySelectorAll('#sidebar > nav > ul > li > a, #sidebar > nav > ul > li > button');
            const menuIcons = document.querySelectorAll('.menu-item svg:first-child'); // Seleciona o primeiro SVG em cada item de menu

            // Alterna a largura da sidebar
            sidebar.classList.toggle('w-64'); // Largura expandida
            sidebar.classList.toggle('w-20'); // Largura minimizada

            const isMinimized = sidebar.classList.contains('w-20');

            // Alterna a visibilidade do texto dos itens do menu
            menuTexts.forEach(text => {
                text.classList.toggle('hidden', isMinimized);
            });

            // Gira o ícone de minimizar
            minimizeIcon.classList.toggle('rotate-180', isMinimized);

            // Ajusta o padding horizontal dos itens de menu principais
            mainMenuItems.forEach(item => {
                item.classList.toggle('px-6', !isMinimized);
                item.classList.toggle('px-3', isMinimized); // Padding menor para o estado minimizado
                item.classList.toggle('justify-center', isMinimized); // Centraliza o conteúdo quando minimizado
                item.classList.toggle('justify-start', !isMinimized); // Alinha à esquerda quando expandido
            });

            // Ajusta a margem dos ícones
            menuIcons.forEach(icon => {
                icon.classList.toggle('mr-3', !isMinimized); // Adiciona mr-3 quando expandido
                icon.classList.toggle('mr-0', isMinimized); // Remove mr-3 quando minimizado
            });

            // Se a sidebar está sendo minimizada, fecha o submenu de Conteúdos se estiver aberto
            const submenu = document.getElementById('submenu');
            const submenuIcon = document.getElementById('submenu-icon');
            if (isMinimized) {
                if (!submenu.classList.contains('hidden')) {
                    submenu.classList.add('hidden');
                    submenuIcon.classList.remove('rotate-180');
                }
                // Oculta a seta do submenu de Conteúdos quando a sidebar está minimizada
                submenuIcon.classList.add('hidden');
            } else {
                // Mostra a seta do submenu de Conteúdos quando a sidebar está expandida
                submenuIcon.classList.remove('hidden');
            }
        }

        // Torna as funções acessíveis globalmente
        window.toggleSubMenu = toggleSubMenu;
        window.toggleSidebar = toggleSidebar;
    };
</script>