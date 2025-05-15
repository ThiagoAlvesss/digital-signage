<x-guest-layout>
    <form method="POST" action="{{ route('players.update', $player->id) }}">
        @csrf
        @method('PUT') <!-- Isso define o método como PUT -->

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$player->name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Location -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Localização')" />
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="$player->location" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Playlist -->
        <div class="mt-4">
            <x-input-label for="playlist_id" :value="__('Playlist')" />
            <select id="playlist_id" name="playlist_id" class="block mt-1 w-full">
                <option value="">Selecione uma playlist</option>
                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}" {{ $player->playlist_id == $playlist->id ? 'selected' : '' }}>{{ $playlist->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('playlist_id')" class="mt-2" />
        </div>

        <!-- Identifier -->
        <div class="mt-4">
            <x-input-label for="identifier" :value="__('Identificador')" />
            <x-text-input id="identifier" class="block mt-1 w-full" type="text" name="identifier" :value="$player->identifier" required />
            <x-input-error :messages="$errors->get('identifier')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Atualizar Player') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
