<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Lista de Conteúdos</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('contents.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700">Adicionar Novo Conteúdo</a>

    @if($contents->isEmpty())
        <p>Nenhum conteúdo cadastrado.</p>
    @else
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr>
                    <th class="border px-4 py-2 text-left">Título</th>
                    <th class="border px-4 py-2 text-left">Tipo</th>
                    <th class="border px-4 py-2 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                    <tr>
                        <td class="border px-4 py-2">{{ $content->title }}</td>
                        <td class="border px-4 py-2 capitalize">{{ $content->type }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('contents.edit', $content->id) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                            <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este conteúdo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 cursor-pointer">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>

