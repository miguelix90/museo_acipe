@extends('layouts.museo')

@section('title', 'Libros - Museo ACIPE')

@section('content')

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        
        <!-- Título y buscador -->
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <p class="text-[#111418] tracking-light text-[32px] font-bold leading-tight min-w-72">Biblioteca</p>
        </div>
        
        <div class="px-4 py-3">
            <label class="flex flex-col min-w-40 h-14 w-full">
                <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                    <div class="text-[#617589] flex border border-[#dce0e5] bg-white items-center justify-center pl-[15px] rounded-l-xl border-r-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                        </svg>
                    </div>
                    <input placeholder="Buscar libros por título o autor" 
                           class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111418] focus:outline-0 focus:ring-0 border border-[#dce0e5] bg-white focus:border-[#dce0e5] h-full placeholder:text-[#617589] px-[15px] rounded-r-none border-r-0 pr-2 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" 
                           value="">
                    <div class="flex items-center justify-center rounded-r-xl border-l-0 border border-[#dce0e5] bg-white pr-[7px]">
                        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#1380ec] text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Buscar</span>
                        </button>
                    </div>
                </div>
            </label>
        </div>

        <!-- Grid de libros -->
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            @forelse($libros as $libro)
            <div class="flex flex-col gap-3">
                <!-- Portada del libro -->
                <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-lg"
                     @if($libro->url_imagen_portada)
                     style='background-image: url("{{ $libro->url_imagen_portada }}");'
                     @elseif($libro->hasMedia('imagen_libro'))
                     style='background-image: url("{{ $libro->getFirstMediaUrl('imagen_libro', 'medium') }}");'
                     @else
                     style='background-image: url("https://placehold.co/300x400/e5e7eb/64748b?text=Libro");'
                     @endif>
                </div>
                
                <!-- Información del libro -->
                <div class="flex flex-col gap-1">
                    <p class="text-[#111418] text-base font-medium leading-normal">
                        {{ $libro->titulo }}
                    </p>
                    <p class="text-[#617589] text-sm font-normal leading-normal">
                        {{ $libro->autor }}
                    </p>
                    @if($libro->fecha_edicion)
                    <p class="text-[#9dafbd] text-xs font-normal leading-normal">
                        {{ $libro->fecha_edicion }}
                    </p>
                    @endif
                    
                    @if($libro->url_resena)
                    <a href="{{ $libro->url_resena }}" target="_blank" rel="noopener"
                       class="text-[#1380ec] text-sm font-medium hover:underline mt-2">
                        Ver reseña →
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-[#617589] text-lg">No hay libros disponibles en este momento.</p>
            </div>
            @endforelse
        </div>
        
    </div>
</div>

@endsection
