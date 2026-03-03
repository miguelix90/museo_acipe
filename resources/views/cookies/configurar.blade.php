@extends('layouts.museo')

@section('title', 'Configuración de Cookies - Museo ACIPE')

@section('content')

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <h1 class="text-[#111418] tracking-light text-[32px] font-bold leading-tight min-w-72">Configuración de Cookies</h1>
        </div>

        <div class="p-4">
            <p class="text-gray-600 mb-8">
                Aquí puede personalizar qué cookies acepta. Las cookies técnicas son necesarias para el funcionamiento del sitio.
            </p>

            <!-- Cookies Técnicas -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold mb-2">Cookies Técnicas (Necesarias)</h3>
                        <p class="text-sm text-gray-600">
                            Estas cookies son esenciales para el funcionamiento básico del sitio web. No pueden ser desactivadas.
                        </p>
                    </div>
                    <div class="ml-4">
                        <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg text-sm font-medium">
                            Siempre activas
                        </span>
                    </div>
                </div>
            </div>

            <!-- Cookies de Terceros -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold mb-2">Cookies de Terceros</h3>
                        <p class="text-sm text-gray-600">
                            Cookies establecidas por servicios externos (WordPress ACIPE.es para cargar publicaciones).
                        </p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="thirdPartyCookies" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1380ec]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button onclick="savePreferences()" 
                        class="px-6 py-3 bg-[#1380ec] text-white font-medium rounded-lg hover:bg-[#0d5bb5] transition">
                    Guardar Preferencias
                </button>
                <a href="{{ route('museo.home') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </div>
        
    </div>
</div>

<script>
function savePreferences() {
    const thirdParty = document.getElementById('thirdPartyCookies').checked;
    const consent = thirdParty ? 'accepted' : 'rejected';
    
    // Guardar cookie
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = `museo_cookie_consent=${consent};expires=${date.toUTCString()};path=/;SameSite=Lax`;
    
    // Mostrar confirmación
    alert('✅ Preferencias guardadas correctamente');
    window.location.href = '{{ route('museo.home') }}';
}
</script>

@endsection
