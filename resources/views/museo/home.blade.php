@extends('layouts.museo')

@section('title', 'Museo IA de ACIPE')

@section('content')

<!-- Hero Section -->
<div class="@container">
    <div class="@[480px]:p-4">
        <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-lg items-center justify-center p-4"
             style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCtoET09kOUCXBTvlui6OwjSPJMRnLmMBsTUFPTndDebdVtzt5yWUDnMjLGdVwus7RJ5Cv1WFHJuu8Xf9il7wn7O9KiuP9yY-LPX6BLKFOWePIFSYh7vng1OLPeMHocy-SnTf_dFd7BIA-z0925-Er9AbIvXPngHECEHeYhf2X6o6e-bUnB7SnP0pSopszOAFRNbjB9ZUC4tzf34AdZBaOFyUrspC1CL3MbI7Kw4hX1yfo5TRIW2naXaiAGWbTL1r-NIq-xcIVpNVHV");'>
            <div class="flex flex-col gap-2 text-center">
                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                    Donde la Literatura se Encuentra con la Inteligencia Artificial
                </h1>
                <h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                    Explora un museo digital que muestra arte generado por IA inspirado en obras literarias clásicas. Descubre la fusión de narración y tecnología de vanguardia.
                </h2>
            </div>
            <a href="{{ route('museo.exposiciones') }}"
               class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#1380ec] text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                <span class="truncate">Explorar Colecciones</span>
            </a>
        </div>
    </div>
</div>

<!-- About Section -->
<h2 class="text-[#111418] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Sobre Museo ACIPE</h2>
<p class="text-[#111418] text-base font-normal leading-normal pb-3 pt-1 px-4 text-center">
    MuseAI es un museo digital que cierra la brecha entre la literatura y la inteligencia artificial. Nuestros algoritmos de IA analizan obras literarias clásicas y generan piezas de arte únicas y visualmente impactantes que capturan la esencia de cada historia. Nuestro objetivo es proporcionar una nueva perspectiva sobre los libros queridos e inspirar la creatividad a través de la intersección del arte y la tecnología.
</p>

<!-- Última Exposición Destacada -->
@if($destacada)
<h2 class="text-[#111418] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Última Exposición</h2>
<div class="px-4 pb-3">
    <div class="@container">
        <div class="@[480px]:p-4">
            @if($destacada->hasMedia('imagen'))
            <div class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden bg-white @[480px]:rounded-lg min-h-80 cursor-pointer"
                 onclick="openModal('{{ $destacada->getFirstMediaUrl('imagen') }}', '{{ $destacada->titulo }}')"
                 style='background-image: url("{{ $destacada->getFirstMediaUrl('imagen') }}");'></div>
            @else
            <div class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden bg-gray-200 @[480px]:rounded-lg min-h-80"></div>
            @endif
        </div>
    </div>

    <div class="text-center mt-4">
        <h3 class="text-[#111418] text-2xl font-bold leading-tight mb-2">{{ $destacada->titulo }}</h3>
        @if($destacada->subtitulo)
        <p class="text-[#617589] text-lg font-medium mb-2">{{ $destacada->subtitulo }}</p>
        @endif
        <p class="text-[#617589] text-base font-normal leading-normal mb-4">
            {{ Str::limit($destacada->descripcion, 200) }}
        </p>
        <a href="{{ route('museo.exposicion', $destacada->slug) }}"
           class="inline-flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#1380ec] text-white text-sm font-bold leading-normal tracking-[0.015em]">
            <span class="truncate">Ver Exposición</span>
        </a>
    </div>
</div>
@endif

<!-- Siguientes 3 Exposiciones -->
@if($siguientes->count() > 0)
<h2 class="text-[#111418] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Más Exposiciones</h2>
<div class="flex overflow-y-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
    <div class="flex items-stretch p-4 gap-3">
        @foreach($siguientes as $exposicion)
        <div class="flex h-full flex-1 flex-col gap-4 rounded-lg min-w-60">
            @if($exposicion->hasMedia('imagen'))
            <a href="{{ route('museo.exposicion', $exposicion->slug) }}">
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex flex-col cursor-pointer hover:opacity-90 transition"
                     style='background-image: url("{{ $exposicion->getFirstMediaUrl('imagen', 'medium') }}");'></div>
            </a>
            @else
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex flex-col bg-gray-200"></div>
            @endif
            <div>
                <a href="{{ route('museo.exposicion', $exposicion->slug) }}">
                    <p class="text-[#111418] text-base font-medium leading-normal hover:text-[#1380ec]">{{ $exposicion->titulo }}</p>
                </a>
                @if($exposicion->subtitulo)
                <p class="text-[#617589] text-sm font-normal leading-normal mt-1">{{ $exposicion->subtitulo }}</p>
                @endif
                <p class="text-[#617589] text-sm font-normal leading-normal mt-2">
                    {{ Str::limit($exposicion->descripcion, 80) }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Sección de Publicaciones ACIPE -->
<div class="bg-slate-50 py-8 mt-8">
    <div class="max-w-[960px] mx-auto px-4">
        <h2 class="text-[#111418] text-[22px] font-bold leading-tight tracking-[-0.015em] pb-3">Últimas Publicaciones de ACIPE</h2>

        <div id="acipe-posts" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Las publicaciones se cargarán aquí mediante JavaScript -->
            <div class="text-center py-8 col-span-full">
                <p class="text-gray-500">Cargando publicaciones...</p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="https://acipe.es" target="_blank" rel="noopener"
               class="inline-flex items-center justify-center px-6 py-3 bg-[#1380ec] text-white font-medium rounded-lg hover:bg-[#0d5bb5] transition">
                Visita ACIPE.es
            </a>
        </div>
    </div>
</div>

<script>
// Cargar últimas publicaciones de ACIPE mediante API REST de WordPress
document.addEventListener('DOMContentLoaded', async function() {
    const container = document.getElementById('acipe-posts');

    try {
        // Usar API REST de WordPress para obtener posts con ACF fields
        const response = await fetch('https://acipe.es/wp-json/wp/v2/posts?per_page=3&_embed');
        const posts = await response.json();

        if (posts && posts.length > 0) {
            container.innerHTML = posts.map(post => {
                // Intentar obtener imagen de ACF primero
                let image = '';

                // 1. Intentar acf.imagen_api
                if (post.acf && post.acf.imagen_api) {
                    image = post.acf.imagen_api;
                }
                // 2. Intentar featured media embebido
                else if (post._embedded && post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'][0]) {
                    image = post._embedded['wp:featuredmedia'][0].source_url;
                }
                // 3. Imagen por defecto
                else {
                    image = 'https://placehold.co/400x250/e5e7eb/64748b?text=ACIPE';
                }

                // Extraer excerpt limpio (quitar HTML)
                const excerpt = post.excerpt.rendered.replace(/<[^>]*>/g, '').substring(0, 120) + '...';

                // Formatear fecha
                const date = new Date(post.date);
                const formattedDate = date.toLocaleDateString('es-ES', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                return `
                    <div class="flex flex-col bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                        <a href="${post.link}" target="_blank" rel="noopener">
                            <img src="${image}" alt="${post.title.rendered}"
                                 class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4 flex-1 flex flex-col">
                            <a href="${post.link}" target="_blank" rel="noopener">
                                <h3 class="text-[#111418] text-base font-medium leading-normal hover:text-[#1380ec] mb-2">
                                    ${post.title.rendered}
                                </h3>
                            </a>
                            <p class="text-[#617589] text-sm font-normal leading-normal mb-2 flex-1">
                                ${excerpt}
                            </p>
                            <p class="text-[#9dafbd] text-xs font-normal mt-2">
                                ${formattedDate}
                            </p>
                        </div>
                    </div>
                `;
            }).join('');
        } else {
            container.innerHTML = `
                <div class="col-span-full text-center py-4">
                    <p class="text-gray-500">No se pudieron cargar las publicaciones en este momento.</p>
                </div>
            `;
        }
    } catch (error) {
        console.error('Error al cargar publicaciones de ACIPE:', error);
        container.innerHTML = `
            <div class="col-span-full text-center py-4">
                <p class="text-gray-500">Error al cargar las publicaciones. Por favor, intenta más tarde.</p>
            </div>
        `;
    }
});
</script>

@endsection
