@extends('layouts.museo')

@section('title', $sala->titulo . ' - Museo IA de ACIPE')

@section('content')

<!-- Title -->
<div class="flex flex-wrap justify-between gap-3 p-4">
    <p class="text-[#0d141b] tracking-light text-[32px] font-bold leading-tight min-w-72">{{ $sala->titulo }}</p>
</div>

<!-- Main Room Image -->
<div class="flex w-full grow bg-slate-50 @container p-4">
    <div class="w-full gap-1 overflow-hidden bg-slate-50 @[480px]:gap-2 aspect-[3/2] rounded-lg flex">
        @if($sala->hasMedia('imagen_principal'))
        <div class="w-full bg-center bg-no-repeat bg-cover aspect-auto rounded-none flex-1 cursor-pointer"
             onclick="openModal('{{ $sala->getFirstMediaUrl('imagen_principal') }}', '{{ $sala->titulo }}')"
             style='background-image: url("{{ $sala->getFirstMediaUrl('imagen_principal') }}");'></div>
        @else
        <div class="w-full bg-center bg-no-repeat bg-cover aspect-auto rounded-none flex-1 bg-gray-200"></div>
        @endif
    </div>
</div>

<!-- Audio Player (if available) -->
@if($sala->hasMedia('audio'))
<div class="px-4 py-3 text-center">
    <audio controls class="w-full max-w-2xl mx-auto">
        <source src="{{ $sala->getFirstMediaUrl('audio') }}" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>
</div>
@endif

<!-- Books Information Table -->
@if($sala->libros->count() > 0)
<h2 class="text-[#0d141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
    Información de {{ $sala->libros->count() }} {{ $sala->libros->count() == 1 ? 'Libro' : 'Libros' }}
</h2>

<div class="px-4 py-3 @container">
    <div class="flex overflow-hidden rounded-lg border border-[#cfdbe7] bg-slate-50">
        <table class="flex-1">
            <thead>
                <tr class="bg-slate-50">
                    <th class="px-4 py-3 text-left text-[#0d141b] w-32 text-sm font-medium leading-normal">Libro</th>
                    <th class="px-4 py-3 text-left text-[#0d141b] w-[400px] text-sm font-medium leading-normal">Información del Libro</th>
                    <th class="px-4 py-3 text-left text-[#0d141b] w-[300px] text-sm font-medium leading-normal">Nube de Palabras</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sala->libros as $libro)
                <tr class="border-t border-t-[#cfdbe7]">
                    <!-- Book Cover (rectangular like a book) -->
                    <td class="px-4 py-3 w-32 text-sm font-normal leading-normal align-top">
                        <div class="flex flex-col gap-1">
                            @if($libro->url_imagen_portada)
                            <div class="bg-center bg-no-repeat aspect-[3/4] bg-cover rounded w-20 cursor-pointer shadow-sm"
                                 onclick="openModal('{{ $libro->url_imagen_portada }}', 'Portada: {{ $libro->titulo }}')"
                                 style='background-image: url("{{ $libro->url_imagen_portada }}");'></div>
                            @else
                            <div class="bg-gray-200 rounded w-20 aspect-[3/4]"></div>
                            @endif
                            
                            @if($libro->url_resena)
                            <a href="{{ $libro->url_resena }}" target="_blank" rel="noopener"
                               class="text-[#1380ec] text-xs hover:underline">
                                Ver reseña
                            </a>
                            @endif
                        </div>
                    </td>
                    
                    <!-- Book Information -->
                    <td class="px-4 py-3 w-[400px] text-[#0d141b] text-sm font-normal leading-normal align-top">
                        <strong>{{ $libro->titulo }}</strong><br>
                        Autor: {{ $libro->autor }}<br>
                        @if($libro->fecha_edicion)
                        Edición: {{ $libro->fecha_edicion }}
                        @endif
                    </td>
                    
                    <!-- Word Cloud -->
                    <td class="px-4 py-3 w-[300px] text-[#4c739a] text-sm font-normal leading-normal align-top">
                        @if($libro->hasMedia('imagen_nube_palabras'))
                        <div class="cursor-pointer hover:opacity-80 transition" 
                             onclick="openModal('{{ $libro->getFirstMediaUrl('imagen_nube_palabras') }}', 'Nube de palabras: {{ $libro->titulo }}')">
                            <img src="{{ $libro->getFirstMediaUrl('imagen_nube_palabras', 'thumb') }}" 
                                 alt="Nube de palabras: {{ $libro->titulo }}"
                                 class="w-32 rounded shadow-sm border border-gray-200">
                            <p class="text-xs text-[#4c739a] mt-1">Click para ampliar</p>
                        </div>
                        @else
                        <span class="text-gray-400">Nube de palabras no disponible</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="p-4 text-center">
    <p class="text-gray-500">No hay libros asociados a esta sala.</p>
</div>
@endif

<!-- Back Button -->
<div class="px-4 py-5 text-center">
    <a href="{{ route('museo.exposicion', $exposicion->slug) }}"
       class="inline-flex items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-[#1380ec] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0d5bb5] transition">
        ← Volver a la Exposición
    </a>
</div>

@endsection
