<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div style="max-width: 600px; margin: 2rem auto; text-align: center;">

                    <a href="{{ route('contents.index') }}"
                        style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                        Gerenciar Conteúdos
                    </a>
                </div>
                <div style="max-width: 600px; margin: 2rem auto; text-align: center;">

                    <a href="{{ route('playlists.index') }}"
                        style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                        Gerenciar Playlists
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>