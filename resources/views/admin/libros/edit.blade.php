@extends('layouts.admin')

@section('title', 'Editar Libro')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.libros.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Volver a libros
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Editar Libro</h2>

    <form action="{{ route('admin.libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título *</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $libro->titulo) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('titulo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Autor -->
            <div>
                <label for="autor" class="block text-sm font-medium text-gray-700">Autor *</label>
                <input type="text" name="autor" id="autor" value="{{ old('autor', $libro->autor) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('autor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Edición -->
            <div>
                <label for="fecha_edicion" class="block text-sm font-medium text-gray-700">Fecha de Edición</label>
                <input type="text" name="fecha_edicion" id="fecha_edicion" 
                    value="{{ old('fecha_edicion', $libro->fecha_edicion) }}"
                    placeholder="Ej: 2020, 1998-2000, 2015"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <p class="mt-1 text-sm text-gray-500">Puedes escribir un año o rango de años</p>
                @error('fecha_edicion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL Imagen Portada -->
            <div>
                <label for="url_imagen_portada" class="block text-sm font-medium text-gray-700">URL Imagen Portada *</label>
                <input type="url" name="url_imagen_portada" id="url_imagen_portada" 
                    value="{{ old('url_imagen_portada', $libro->url_imagen_portada) }}"
                    placeholder="https://ejemplo.com/imagen-portada.jpg"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <p class="mt-1 text-sm text-gray-500">URL de la imagen de portada del libro</p>
                @error('url_imagen_portada')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL Reseña -->
            <div>
                <label for="url_resena" class="block text-sm font-medium text-gray-700">URL Reseña</label>
                <input type="url" name="url_resena" id="url_resena" 
                    value="{{ old('url_resena', $libro->url_resena) }}"
                    placeholder="https://ejemplo.com/resena-libro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <p class="mt-1 text-sm text-gray-500">URL de la reseña del libro</p>
                @error('url_resena')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagen Nube de Palabras Actual -->
            @if($libro->hasMedia('imagen_nube_palabras'))
            <div>
                <label class="block text-sm font-medium text-gray-700">Nube de Palabras Actual</label>
                <img src="{{ $libro->getFirstMediaUrl('imagen_nube_palabras', 'large') }}" alt="Nube de palabras" 
                    class="mt-2 h-48 rounded border">
            </div>
            @endif

            <!-- Nueva Imagen Nube de Palabras -->
            <div>
                <label for="imagen_nube_palabras" class="block text-sm font-medium text-gray-700">{{ $libro->hasMedia('imagen_nube_palabras') ? 'Cambiar Nube de Palabras' : 'Imagen Nube de Palabras' }}</label>
                <input type="file" name="imagen_nube_palabras" id="imagen_nube_palabras" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-purple-50 file:text-purple-700
                    hover:file:bg-purple-100">
                <p class="mt-1 text-sm text-gray-500">Formatos: JPG, PNG. Tamaño máximo: 5MB</p>
                @error('imagen_nube_palabras')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.libros.index') }}" 
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                Cancelar
            </a>
            <button type="submit" 
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
                Actualizar Libro
            </button>
        </div>
    </form>
</div>
@endsection
