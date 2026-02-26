@extends('layouts.museo')

@section('title', 'Salas - Museo ACIPE')

@section('content')

<!-- Title -->
<div class="flex flex-wrap justify-between gap-3 p-4">
    <p class="text-[#0d141b] tracking-light text-[32px] font-bold leading-tight min-w-72">Índice de Salas</p>
</div>

<!-- Search Bar -->
<div class="px-4 py-3">
    <label class="flex flex-col min-w-40 h-12 w-full">
        <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
            <div class="text-[#4c739a] flex border-none bg-[#e7edf3] items-center justify-center pl-4 rounded-l-lg border-r-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                </svg>
            </div>
            <input id="searchSalas" 
                   type="text"
                   placeholder="Buscar salas por tema o exposición" 
                   class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d141b] focus:outline-0 focus:ring-0 border-none bg-[#e7edf3] focus:border-none h-full placeholder:text-[#4c739a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                   value="" />
        </div>
    </label>
</div>

<!-- Salas List -->
<div id="salasList">
    @forelse($salas as $sala)
    <div class="p-4 sala-item" data-titulo="{{ strtolower($sala->titulo) }}" data-exposicion="{{ strtolower($sala->exposicion->titulo ?? '') }}">
        <div class="flex items-stretch justify-between gap-4 rounded-lg">
            <div class="flex flex-[2_2_0px] flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <p class="text-[#0d141b] text-base font-bold leading-tight">{{ $sala->titulo }}</p>
                    @if($sala->exposicion)
                    <p class="text-[#1380ec] text-xs font-medium leading-normal">{{ $sala->exposicion->titulo }}</p>
                    @endif
                </div>
                <a href="{{ route('museo.sala', [$sala->exposicion->slug, $sala->slug]) }}"
                   class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 flex-row-reverse bg-[#e7edf3] text-[#0d141b] text-sm font-medium leading-normal w-fit">
                    <span class="truncate">Explorar</span>
                </a>
            </div>
            @if($sala->hasMedia('imagen_principal'))
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1 cursor-pointer"
                 onclick="openModal('{{ $sala->getFirstMediaUrl('imagen_principal') }}', '{{ $sala->titulo }}')"
                 style='background-image: url("{{ $sala->getFirstMediaUrl('imagen_principal', 'large') }}");'></div>
            @else
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1 bg-gray-200"></div>
            @endif
        </div>
    </div>
    @empty
    <div class="p-4 text-center">
        <p class="text-gray-500">No hay salas disponibles.</p>
    </div>
    @endforelse
</div>

<!-- No results message -->
<div id="noResultsSalas" class="p-4 text-center hidden">
    <p class="text-gray-500">No se encontraron salas que coincidan con tu búsqueda.</p>
</div>

<script>
// Buscador de salas
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchSalas');
    const salasList = document.querySelectorAll('.sala-item');
    const noResults = document.getElementById('noResultsSalas');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;
        
        salasList.forEach(function(item) {
            const titulo = item.getAttribute('data-titulo');
            const exposicion = item.getAttribute('data-exposicion');
            
            if (titulo.includes(searchTerm) || exposicion.includes(searchTerm)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Mostrar/ocultar mensaje de "no hay resultados"
        if (visibleCount === 0 && searchTerm !== '') {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    });
});
</script>

@endsection
