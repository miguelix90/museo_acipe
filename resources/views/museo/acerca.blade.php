@extends('layouts.museo')

@section('title', 'Metodología y Guía del Proyecto - Museo ACIPE')

@section('content')

<style>
    .serif-heading {
        font-family: 'Playfair Display', serif;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<!-- Header de la página -->
<header class="py-16 px-6 max-w-5xl mx-auto border-b border-slate-200">
    <h1 class="serif-heading text-5xl md:text-6xl font-bold leading-tight mb-6">Metodología y Guía del Proyecto</h1>
    <p class="text-lg text-slate-600 max-w-2xl leading-relaxed">
        Explorando la intersección entre la literatura científica, el análisis semántico y la vanguardia de la inteligencia artificial generativa.
    </p>
</header>

<!-- Main content -->
<main class="max-w-5xl mx-auto px-6 py-20 space-y-32">

    <!-- 01. El Concepto -->
    <section class="grid md:grid-cols-12 gap-12 items-start" id="concepto">
        <div class="md:col-span-4 sticky top-12">
            <div class="flex items-center gap-3 text-[#1380ec] mb-4">
                <span class="material-icons-outlined">auto_stories</span>
                <span class="font-semibold uppercase tracking-widest text-xs">01. El Concepto</span>
            </div>
            <h2 class="serif-heading text-4xl mb-6">¿Libro exposición?</h2>
        </div>
        <div class="md:col-span-8 prose prose-slate max-w-none">
            <p class="text-xl leading-relaxed font-light">
                ACIPE viene recomendando buenos <span class="font-semibold">libros de ciencia</span> desde hace ya algún tiempo. La idea de <span class="text-[#1380ec] italic">libro-exposición</span> surgió como una forma alternativa de presentar las recensiones de estos libros.
            </p>
            <p class="leading-relaxed">
                Buscamos una simbiosis entre el rigor académico y la estética contemporánea, aunando la <span class="font-medium underline decoration-[#1380ec] decoration-2 underline-offset-4">presentación visual generada por Inteligencia Artificial</span> con la agrupación temática de las recensiones literarias.
            </p>
        </div>
    </section>

    <!-- 02. Tecnología -->
    <section class="grid md:grid-cols-12 gap-12 items-start" id="metodologia">
        <div class="md:col-span-4 sticky top-12">
            <div class="flex items-center gap-3 text-[#1380ec] mb-4">
                <span class="material-icons-outlined">psychology</span>
                <span class="font-semibold uppercase tracking-widest text-xs">02. Tecnología</span>
            </div>
            <h2 class="serif-heading text-4xl mb-6">Arte generado por IA</h2>
        </div>
        <div class="md:col-span-8">
            <div class="glass-card p-8 rounded-xl shadow-sm space-y-6">
                <p class="leading-relaxed">
                    El algoritmo empleado para generar las imágenes se denomina <span class="font-mono bg-slate-200 px-2 py-0.5 rounded text-sm">VQGAN+CLIP</span>. Es un tipo de Red Generativa Antagónica (GAN), compuesta por dos redes neuronales que trabajan en conjunto:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 border border-slate-200 rounded-lg">
                        <span class="material-icons-outlined text-[#1380ec] mb-2">brush</span>
                        <h4 class="font-semibold mb-2">El Creador</h4>
                        <p class="text-sm text-slate-600">Una red aprende a generar imágenes desde cero basándose en descripciones textuales.</p>
                    </div>
                    <div class="p-5 border border-slate-200 rounded-lg">
                        <span class="material-icons-outlined text-[#1380ec] mb-2">fact_check</span>
                        <h4 class="font-semibold mb-2">El Supervisor</h4>
                        <p class="text-sm text-slate-600">Supervisa la calidad y fidelidad, rechazando aquellas que no alcanzan el estándar deseado.</p>
                    </div>
                </div>
                <p class="text-sm italic opacity-75">
                    Desde la exposición 2 de este Museo Digital se está empleando la solución derivada de algoritmos elegidos del portal Wombo Dream.
                </p>
            </div>
        </div>
    </section>

    <!-- 03. Nubes de palabras -->
    <section class="grid md:grid-cols-12 gap-12 items-start" id="nubes">
        <div class="md:col-span-4 sticky top-12">
            <div class="flex items-center gap-3 text-[#1380ec] mb-4">
                <span class="material-icons-outlined">cloud_queue</span>
                <span class="font-semibold uppercase tracking-widest text-xs">03. Visualización</span>
            </div>
            <h2 class="serif-heading text-4xl mb-6">Nubes de palabras</h2>
        </div>
        <div class="md:col-span-8 flex flex-col items-center md:items-start">
            <p class="mb-8 leading-relaxed">
                Las nubes de palabras son <span class="font-semibold">formas visuales</span> que presentan las palabras por tamaños según su frecuencia de aparición en el texto. Nos ayudan a captar una <span class="italic">primera idea</span> del contenido del libro de forma intuitiva.
            </p>
            <div class="relative w-full aspect-video bg-slate-100 rounded-2xl overflow-hidden flex items-center justify-center p-8 group">
                <div class="flex flex-wrap gap-4 justify-center items-center max-w-md">
                    <span class="text-4xl font-bold opacity-30 group-hover:opacity-100 transition-opacity">Ciencia</span>
                    <span class="text-xl font-medium opacity-20 group-hover:opacity-80 transition-opacity">Teoría</span>
                    <span class="text-5xl font-black text-[#1380ec] opacity-40 group-hover:opacity-100 transition-opacity">IA</span>
                    <span class="text-2xl font-light opacity-25 group-hover:opacity-90 transition-opacity">Metodología</span>
                    <span class="text-3xl font-semibold opacity-30 group-hover:opacity-100 transition-opacity">Futuro</span>
                    <span class="text-lg opacity-20 group-hover:opacity-70 transition-opacity">Simbiosis</span>
                    <span class="text-4xl font-serif italic opacity-35 group-hover:opacity-100 transition-opacity">Arte</span>
                </div>
                <div class="absolute inset-0 border-2 border-dashed border-slate-300 m-4 rounded-xl pointer-events-none"></div>
            </div>
        </div>
    </section>

    <!-- 04. Guía de visita -->
    <section class="grid md:grid-cols-12 gap-12 items-start" id="guia">
        <div class="md:col-span-4 sticky top-12">
            <div class="flex items-center gap-3 text-[#1380ec] mb-4">
                <span class="material-icons-outlined">explore</span>
                <span class="font-semibold uppercase tracking-widest text-xs">04. Interactividad</span>
            </div>
            <h2 class="serif-heading text-4xl mb-6">Guía de visita</h2>
        </div>
        <div class="md:col-span-8">
            <div class="space-y-6">
                <div class="flex gap-6 group">
                    <div class="flex-none w-10 h-10 rounded-full bg-[#1380ec]/10 text-[#1380ec] flex items-center justify-center font-bold">1</div>
                    <div class="border-b border-slate-200 pb-6 w-full">
                        <p class="leading-relaxed">Encuentre el <span class="font-semibold">cuadro y el texto pertinente</span> de las salas. Desplace su cursor sobre el cuadro para activarlo.</p>
                    </div>
                </div>
                <div class="flex gap-6 group">
                    <div class="flex-none w-10 h-10 rounded-full bg-[#1380ec]/10 text-[#1380ec] flex items-center justify-center font-bold">2</div>
                    <div class="border-b border-slate-200 pb-6 w-full">
                        <p class="leading-relaxed">Al <span class="font-semibold">pinchar sobre el cuadro</span>, aparecerá un carrusel dinámico con sus cuatro salas correspondientes.</p>
                    </div>
                </div>
                <div class="flex gap-6 group">
                    <div class="flex-none w-10 h-10 rounded-full bg-[#1380ec]/10 text-[#1380ec] flex items-center justify-center font-bold">3</div>
                    <div class="border-b border-slate-200 pb-6 w-full">
                        <p class="leading-relaxed">Pinchando en una de las salas, podrá acceder al <span class="font-semibold text-[#1380ec]">interior</span> para una inmersión completa.</p>
                    </div>
                </div>
                <div class="flex gap-6 group">
                    <div class="flex-none w-10 h-10 rounded-full bg-[#1380ec]/10 text-[#1380ec] flex items-center justify-center font-bold">4</div>
                    <div class="border-b border-slate-200 pb-6 w-full">
                        <p class="leading-relaxed">Cada nube es interactiva: al pinchar, accederá a la <span class="font-semibold">portada del libro</span> y posteriormente a la recensión completa.</p>
                    </div>
                </div>
            </div>
            <div class="mt-12 p-6 bg-slate-50 rounded-lg border-l-4 border-[#1380ec] italic text-sm">
                Nota: En el modo "Solo Exposiciones", la Nube de Palabras es el primer punto de contacto visual en lugar del cuadro artístico.
            </div>
        </div>
    </section>

    <!-- 05. Equipo -->
    <section class="grid md:grid-cols-12 gap-12 items-start border-t border-slate-200 pt-32 pb-20" id="equipo">
        <div class="md:col-span-4">
            <div class="flex items-center gap-3 text-[#1380ec] mb-4">
                <span class="material-icons-outlined">groups</span>
                <span class="font-semibold uppercase tracking-widest text-xs">05. Créditos</span>
            </div>
            <h2 class="serif-heading text-4xl mb-6">Equipo Organizador</h2>
        </div>
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="flex flex-col">
                <span class="text-xs uppercase tracking-tighter text-slate-500 mb-1">Diseño de Exposición</span>
                <span class="text-lg font-medium">Juan Fernández</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs uppercase tracking-tighter text-slate-500 mb-1">Inteligencia Artificial</span>
                <span class="text-lg font-medium">Javier Aroztegui</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs uppercase tracking-tighter text-slate-500 mb-1">Desarrollo Web</span>
                <span class="text-lg font-medium">Miguel Ángel Huete</span>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<footer class="bg-slate-100 py-12 px-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
        <p>© 2024 Museo Digital AI - ACIPE. Todos los derechos reservados.</p>
        <div class="flex gap-8 mt-6 md:mt-0">
            <a class="hover:text-[#1380ec] transition-colors" href="#">Aviso Legal</a>
            <a class="hover:text-[#1380ec] transition-colors" href="#">Privacidad</a>
            <a class="hover:text-[#1380ec] transition-colors" href="https://acipe.es" target="_blank" rel="noopener">Contacto</a>
        </div>
    </div>
</footer>

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Material+Icons+Outlined&display=swap" rel="stylesheet">

@endsection
