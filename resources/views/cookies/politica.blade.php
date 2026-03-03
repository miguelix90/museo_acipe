@extends('layouts.museo')

@section('title', 'Política de Cookies - Museo ACIPE')

@section('content')

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        
        <!-- Título -->
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <h1 class="text-[#111418] tracking-light text-[32px] font-bold leading-tight min-w-72">Política de Cookies</h1>
        </div>

        <!-- Contenido -->
        <div class="p-4 prose prose-slate max-w-none">
            
            <p class="text-sm text-gray-500">Última actualización: {{ date('d/m/Y') }}</p>

            <h2 class="text-2xl font-bold mt-8 mb-4">1. ¿Qué son las cookies?</h2>
            <p>
                Las cookies son pequeños archivos de texto que se almacenan en su dispositivo cuando visita un sitio web. 
                Se utilizan ampliamente para que los sitios web funcionen de manera más eficiente y proporcionen información 
                a los propietarios del sitio.
            </p>

            <h2 class="text-2xl font-bold mt-8 mb-4">2. ¿Qué cookies utilizamos?</h2>
            
            <h3 class="text-xl font-semibold mt-6 mb-3">Cookies Técnicas (Necesarias)</h3>
            <p>Estas cookies son esenciales para el funcionamiento del sitio web:</p>
            
            <div class="bg-gray-50 p-6 rounded-lg my-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 font-semibold">Cookie</th>
                            <th class="text-left py-2 font-semibold">Propósito</th>
                            <th class="text-left py-2 font-semibold">Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 font-mono text-xs">laravel_session</td>
                            <td class="py-3">Mantiene la sesión del usuario activa</td>
                            <td class="py-3">120 minutos</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 font-mono text-xs">XSRF-TOKEN</td>
                            <td class="py-3">Protección contra ataques CSRF (seguridad)</td>
                            <td class="py-3">Sesión</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 font-mono text-xs">remember_web</td>
                            <td class="py-3">"Recordarme" en el inicio de sesión (opcional)</td>
                            <td class="py-3">5 años</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono text-xs">museo_cookie_consent</td>
                            <td class="py-3">Almacena su preferencia de cookies</td>
                            <td class="py-3">365 días</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 class="text-xl font-semibold mt-6 mb-3">Cookies de Terceros</h3>
            <p>
                Este sitio web puede cargar contenido de terceros, específicamente publicaciones desde 
                <strong>acipe.es</strong> (WordPress). Estas integraciones pueden establecer sus propias cookies.
            </p>

            <h2 class="text-2xl font-bold mt-8 mb-4">3. ¿Cómo gestionar las cookies?</h2>
            <p>
                Puede aceptar, rechazar o configurar las cookies mediante nuestro banner de consentimiento. 
                También puede gestionar las cookies directamente desde la configuración de su navegador:
            </p>

            <ul class="list-disc list-inside space-y-2 my-4">
                <li><strong>Google Chrome:</strong> Configuración > Privacidad y seguridad > Cookies</li>
                <li><strong>Firefox:</strong> Opciones > Privacidad y seguridad > Cookies</li>
                <li><strong>Safari:</strong> Preferencias > Privacidad > Cookies</li>
                <li><strong>Microsoft Edge:</strong> Configuración > Privacidad > Cookies</li>
            </ul>

            <div class="bg-blue-50 border-l-4 border-[#1380ec] p-4 my-6">
                <p class="text-sm">
                    <strong>⚠️ Importante:</strong> Si desactiva las cookies técnicas, algunas funcionalidades del sitio 
                    pueden no funcionar correctamente (por ejemplo, el inicio de sesión en el panel de administración).
                </p>
            </div>

            <h2 class="text-2xl font-bold mt-8 mb-4">4. Base legal</h2>
            <p>
                El tratamiento de datos mediante cookies se basa en:
            </p>
            <ul class="list-disc list-inside space-y-2 my-4">
                <li><strong>RGPD (UE) 2016/679:</strong> Reglamento General de Protección de Datos</li>
                <li><strong>LSSI:</strong> Ley 34/2002 de Servicios de la Sociedad de la Información</li>
                <li><strong>LOPDGDD:</strong> Ley Orgánica 3/2018 de Protección de Datos</li>
            </ul>

            <h2 class="text-2xl font-bold mt-8 mb-4">5. Actualizaciones</h2>
            <p>
                Esta Política de Cookies puede ser actualizada. Le recomendamos revisarla periódicamente.
            </p>

            <h2 class="text-2xl font-bold mt-8 mb-4">6. Contacto</h2>
            <p>
                Para cualquier consulta sobre nuestra Política de Cookies, puede contactar con:
            </p>
            <p class="my-4">
                <strong>ACIPE</strong><br>
                Asociación Colegial de Ingenieros de Caminos, Canales y Puertos<br>
                Web: <a href="https://acipe.es" target="_blank" rel="noopener" class="text-[#1380ec] hover:underline">acipe.es</a>
            </p>

            <div class="flex gap-4 mt-8 pt-8 border-t border-gray-200">
                <a href="{{ route('museo.home') }}" 
                   class="px-6 py-3 bg-[#1380ec] text-white font-medium rounded-lg hover:bg-[#0d5bb5] transition">
                    Volver al Inicio
                </a>
                <a href="{{ route('cookies.configurar') }}" 
                   class="px-6 py-3 border border-[#1380ec] text-[#1380ec] font-medium rounded-lg hover:bg-[#1380ec] hover:text-white transition">
                    Configurar Cookies
                </a>
            </div>
        </div>
        
    </div>
</div>

@endsection
