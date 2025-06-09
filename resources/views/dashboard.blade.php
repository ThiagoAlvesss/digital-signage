<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex">
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8" style="width: 400px;">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">

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
                    <div style="max-width: 600px; margin: 2rem auto; text-align: center;">

                        <a href="{{ route('players.index') }}"
                            style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            Gerenciar Players
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 w-full" style="width: 600px;">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
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
                    <div style="max-width: 600px; margin: 2rem auto; text-align: center;">

                        <a href="{{ route('players.index') }}"
                            style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            Gerenciar Players
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>