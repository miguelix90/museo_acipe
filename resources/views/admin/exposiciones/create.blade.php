@extends('layouts.admin')

@section('title', 'Nueva Exposición')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.exposiciones.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Volver a exposiciones
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Nueva Exposición</h2>

    <form action="{{ route('admin.exposiciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título *</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('titulo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtítulo -->
            <div>
                <label for="subtitulo" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                <input type="text" name="subtitulo" id="subtitulo" value="{{ old('subtitulo') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('subtitulo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagen -->
            <div>
                <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                <p class="mt-1 text-sm text-gray-500">Formatos: JPG, PNG. Tamaño máximo: 5MB</p>
                @error('imagen')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" name="orden" id="orden" value="{{ old('orden', 0) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('orden')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activa -->
            <div class="flex items-center">
                <input type="checkbox" name="activa" id="activa" value="1" {{ old('activa', true) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="activa" class="ml-2 block text-sm text-gray-900">
                    Exposición activa
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.exposiciones.index') }}" 
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                Cancelar
            </a>
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Crear Exposición
            </button>
        </div>
    </form>
</div>
@endsection
