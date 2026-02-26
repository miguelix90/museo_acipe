@extends('layouts.museo')

@section('title', 'Exposiciones - Museo IA de ACIPE')

@section('content')

<!-- Title -->
<div class="flex flex-wrap justify-between gap-3 p-4">
    <p class="text-[#0d141b] tracking-light text-[32px] font-bold leading-tight min-w-72">Índice de Exposiciones</p>
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
            <input id="searchExposiciones" 
                   type="text"
                   placeholder="Buscar exposiciones por libro o tema" 
                   class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d141b] focus:outline-0 focus:ring-0 border-none bg-[#e7edf3] focus:border-none h-full placeholder:text-[#4c739a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                   value="" />
        </div>
    </label>
</div>

<!-- Exhibition List -->
<div id="exposicionesList">
    @forelse($exposiciones as $exposicion)
    <div class="p-4 exposicion-item" data-titulo="{{ strtolower($exposicion->titulo) }}" data-descripcion="{{ strtolower($exposicion->descripcion ?? '') }}">
        <div class="flex items-stretch justify-between gap-4 rounded-lg">
            <div class="flex flex-[2_2_0px] flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <p class="text-[#0d141b] text-base font-bold leading-tight">{{ $exposicion->titulo }}</p>
                    <p class="text-[#4c739a] text-sm font-normal leading-normal">
                        {{ $exposicion->descripcion ?? 'Sin descripción disponible' }}
                    </p>
                </div>
                <a href="{{ route('museo.exposicion', $exposicion->slug) }}"
                   class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 flex-row-reverse bg-[#e7edf3] text-[#0d141b] text-sm font-medium leading-normal w-fit">
                    <span class="truncate">Explorar</span>
                </a>
            </div>
            @if($exposicion->hasMedia('imagen'))
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1 cursor-pointer"
                 onclick="openModal('{{ $exposicion->getFirstMediaUrl('imagen') }}', '{{ $exposicion->titulo }}')"
                 style='background-image: url("{{ $exposicion->getFirstMediaUrl('imagen', 'medium') }}");'></div>
            @else
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1 bg-gray-200"></div>
            @endif
        </div>
    </div>
    @empty
    <div class="p-4 text-center">
        <p class="text-gray-500">No hay exposiciones disponibles.</p>
    </div>
    @endforelse
</div>

<!-- No results message -->
<div id="noResultsExposiciones" class="p-4 text-center hidden">
    <p class="text-gray-500">No se encontraron exposiciones que coincidan con tu búsqueda.</p>
</div>

<script>
// Buscador de exposiciones
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchExposiciones');
    const exposicionesList = document.querySelectorAll('.exposicion-item');
    const noResults = document.getElementById('noResultsExposiciones');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;
        
        exposicionesList.forEach(function(item) {
            const titulo = item.getAttribute('data-titulo');
            const descripcion = item.getAttribute('data-descripcion');
            
            if (titulo.includes(searchTerm) || descripcion.includes(searchTerm)) {
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
