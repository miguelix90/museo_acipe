@extends('layouts.admin')

@section('title', 'Salas')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Salas</h1>
    <a href="{{ route('admin.salas.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        + Nueva Sala
    </a>
</div>

<!-- Buscador -->
<div class="mb-4">
    <form method="GET" action="{{ route('admin.salas.index') }}" class="flex gap-2">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ $search ?? '' }}" 
                   placeholder="Buscar por título o exposición..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
            Buscar
        </button>
        @if($search)
        <a href="{{ route('admin.salas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">
            Limpiar
        </a>
        @endif
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exposición</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Libros</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Audio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($salas as $sala)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($sala->hasMedia('imagen_principal'))
                        <img src="{{ $sala->getFirstMediaUrl('imagen_principal', 'thumb') }}" alt="{{ $sala->titulo }}" class="h-12 w-12 rounded object-cover">
                    @else
                        <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $sala->titulo }}</div>
                    <div class="text-sm text-gray-500">{{ $sala->slug }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-sm text-gray-900">{{ $sala->exposicion->titulo }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                        {{ $sala->libros_count }} libros
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($sala->hasMedia('audio'))
                        <span class="text-green-600">✓</span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($sala->activa)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activa
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactiva
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.salas.edit', $sala) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                    <form action="{{ route('admin.salas.destroy', $sala) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta sala?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    No hay salas registradas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $salas->links() }}
</div>
@endsection
