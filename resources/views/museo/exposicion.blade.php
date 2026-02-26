@extends('layouts.museo')

@section('title', $exposicion->titulo . ' - Museo IA de ACIPE')

@section('content')

<!-- Main Image -->
<div class="@container">
    <div class="@[480px]:px-4 @[480px]:py-3">
        @if($exposicion->hasMedia('imagen'))
        <div class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden bg-white @[480px]:rounded-lg min-h-80 cursor-pointer"
             onclick="openModal('{{ $exposicion->getFirstMediaUrl('imagen') }}', '{{ $exposicion->titulo }}')"
             style='background-image: url("{{ $exposicion->getFirstMediaUrl('imagen') }}");'></div>
        @else
        <div class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden bg-gray-200 @[480px]:rounded-lg min-h-80"></div>
        @endif
    </div>
</div>

<!-- Title and Description -->
<h2 class="text-[#111418] tracking-light text-[28px] font-bold leading-tight px-4 text-center pb-3 pt-5">{{ $exposicion->titulo }}</h2>
@if($exposicion->subtitulo)
<p class="text-[#111418] text-lg font-medium leading-tight px-4 text-center pb-2">{{ $exposicion->subtitulo }}</p>
@endif
<p class="text-[#111418] text-base font-normal leading-normal pb-3 pt-1 px-4 text-center">
    {{ $exposicion->descripcion ?? 'Explora la intrincada relación entre el arte visual y la narrativa en esta cautivadora exposición.' }}
</p>

<!-- Salas Section -->
<h2 class="text-[#111418] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Salas</h2>

@if($exposicion->salas->count() > 0)
<div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
    @foreach($exposicion->salas as $sala)
    <div class="flex flex-col gap-3 pb-3">
        <a href="{{ route('museo.sala', [$exposicion->slug, $sala->slug]) }}">
            @if($sala->hasMedia('imagen_principal'))
            <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg cursor-pointer"
                 style='background-image: url("{{ $sala->getFirstMediaUrl('imagen_principal', 'medium') }}");'></div>
            @else
            <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg bg-gray-200"></div>
            @endif
            <p class="text-[#111418] text-base font-medium leading-normal">{{ $sala->titulo }}</p>
        </a>
    </div>
    @endforeach
</div>
@else
<div class="p-4 text-center">
    <p class="text-gray-500">No hay salas disponibles en esta exposición.</p>
</div>
@endif

@endsection
