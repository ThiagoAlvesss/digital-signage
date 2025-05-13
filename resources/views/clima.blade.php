<x-app-layout>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md mt-10 text-center">
        <h1 class="text-3xl font-extrabold mb-6">Clima em {{ config('services.openweather.city') }}</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600 font-semibold">
                {{ $errors->first() }}
            </div>
        @elseif(isset($clima))
            <div class="space-y-4">
                <div class="flex items-center justify-center space-x-4">
                    <img src="https://openweathermap.org/img/wn/{{ $clima['weather'][0]['icon'] }}@2x.png" alt="Ícone clima" />
                    <div>
                        <p class="text-4xl font-bold">{{ round($clima['main']['temp']) }}°C</p>
                        <p class="capitalize text-gray-600">{{ $clima['weather'][0]['description'] }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 text-gray-700">
                    <div>
                        <p class="font-semibold">Umidade</p>
                        <p>{{ $clima['main']['humidity'] }}%</p>
                    </div>
                    <div>
                        <p class="font-semibold">Vento</p>
                        <p>{{ round($clima['wind']['speed'], 1) }} m/s</p>
                    </div>
                    <div>
                        <p class="font-semibold">Sensação</p>
                        <p>{{ round($clima['main']['feels_like']) }}°C</p>
                    </div>
                </div>
            </div>
        @else
            <p>Carregando dados do clima...</p>
        @endif
    </div>
</x-app-layout>