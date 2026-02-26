@extends('layouts.admin')

@section('title', 'Editar Sala')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.salas.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Volver a salas
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Editar Sala</h2>

    <form action="{{ route('admin.salas.update', $sala) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Exposición -->
            <div>
                <label for="exposicion_id" class="block text-sm font-medium text-gray-700">Exposición *</label>
                <select name="exposicion_id" id="exposicion_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">Selecciona una exposición</option>
                    @foreach($exposiciones as $exposicion)
                        <option value="{{ $exposicion->id }}" {{ old('exposicion_id', $sala->exposicion_id) == $exposicion->id ? 'selected' : '' }}>
                            {{ $exposicion->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('exposicion_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título *</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $sala->titulo) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('titulo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug (readonly) -->
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" id="slug" value="{{ $sala->slug }}" readonly
                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm">
                <p class="mt-1 text-sm text-gray-500">Se genera automáticamente desde el título</p>
            </div>

            <!-- Imagen Principal Actual -->
            @if($sala->hasMedia('imagen_principal'))
            <div>
                <label class="block text-sm font-medium text-gray-700">Imagen Principal Actual</label>
                <img src="{{ $sala->getFirstMediaUrl('imagen_principal', 'medium') }}" alt="{{ $sala->titulo }}" 
                    class="mt-2 h-40 rounded border">
            </div>
            @endif

            <!-- Nueva Imagen Principal -->
            <div>
                <label for="imagen_principal" class="block text-sm font-medium text-gray-700">{{ $sala->hasMedia('imagen_principal') ? 'Cambiar Imagen Principal' : 'Imagen Principal' }}</label>
                <input type="file" name="imagen_principal" id="imagen_principal" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-green-700
                    hover:file:bg-green-100">
                <p class="mt-1 text-sm text-gray-500">Formatos: JPG, PNG. Tamaño máximo: 5MB</p>
                @error('imagen_principal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Audio Actual -->
            @if($sala->hasMedia('audio'))
            <div>
                <label class="block text-sm font-medium text-gray-700">Audio Actual</label>
                <audio controls class="mt-2 w-full">
                    <source src="{{ $sala->getFirstMediaUrl('audio') }}" type="audio/mpeg">
                </audio>
            </div>
            @endif

            <!-- Nuevo Audio -->
            <div>
                <label for="audio" class="block text-sm font-medium text-gray-700">{{ $sala->hasMedia('audio') ? 'Cambiar Audio/Podcast' : 'Audio/Podcast' }}</label>
                <input type="file" name="audio" id="audio" accept="audio/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-green-700
                    hover:file:bg-green-100">
                <p class="mt-1 text-sm text-gray-500">Formatos: MP3, WAV. Tamaño máximo: 10MB</p>
                @error('audio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Libros Asociados -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Libros Asociados</label>
                <div class="border rounded-md p-4 max-h-60 overflow-y-auto">
                    @foreach($libros as $libro)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="libros[]" value="{{ $libro->id }}" id="libro_{{ $libro->id }}"
                                {{ in_array($libro->id, old('libros', $sala->libros->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="libro_{{ $libro->id }}" class="ml-2 block text-sm text-gray-900">
                                {{ $libro->titulo }} - {{ $libro->autor }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('libros')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" name="orden" id="orden" value="{{ old('orden', $sala->orden) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('orden')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activa -->
            <div class="flex items-center">
                <input type="checkbox" name="activa" id="activa" value="1" {{ old('activa', $sala->activa) ? 'checked' : '' }}
                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                <label for="activa" class="ml-2 block text-sm text-gray-900">
                    Sala activa
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.salas.index') }}" 
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                Cancelar
            </a>
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                Actualizar Sala
            </button>
        </div>
    </form>
</div>
@endsection
