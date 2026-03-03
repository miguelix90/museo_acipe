<!-- Cookie Consent Banner -->
<div id="cookieConsent" class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-[#1380ec] shadow-lg z-50 hidden">
    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex-1 text-sm text-gray-700">
                <p class="mb-2">
                    <strong>🍪 Uso de Cookies</strong>
                </p>
                <p>
                    Este sitio web utiliza cookies propias y de terceros para mejorar la experiencia de navegación. 
                    Al continuar navegando, aceptas nuestra 
                    <a href="{{ route('cookies.politica') }}" class="text-[#1380ec] hover:underline font-medium">Política de Cookies</a>.
                </p>
            </div>
            <div class="flex gap-3 flex-shrink-0">
                <button onclick="rejectCookies()" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    Rechazar
                </button>
                <button onclick="acceptCookies()" 
                        class="px-6 py-2 text-sm font-medium text-white bg-[#1380ec] rounded-lg hover:bg-[#0d5bb5] transition">
                    Aceptar
                </button>
                <a href="{{ route('cookies.configurar') }}" 
                   class="px-4 py-2 text-sm font-medium text-[#1380ec] border border-[#1380ec] rounded-lg hover:bg-[#1380ec] hover:text-white transition">
                    Configurar
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Cookie Consent Management
(function() {
    'use strict';
    
    const CONSENT_COOKIE = 'museo_cookie_consent';
    const CONSENT_DURATION = 365; // días
    
    // Mostrar banner si no hay consentimiento
    function checkConsent() {
        const consent = getCookie(CONSENT_COOKIE);
        if (!consent) {
            showBanner();
        } else {
            applyConsent(consent);
        }
    }
    
    // Mostrar banner
    function showBanner() {
        const banner = document.getElementById('cookieConsent');
        if (banner) {
            banner.classList.remove('hidden');
        }
    }
    
    // Ocultar banner
    function hideBanner() {
        const banner = document.getElementById('cookieConsent');
        if (banner) {
            banner.classList.add('hidden');
        }
    }
    
    // Aceptar todas las cookies
    window.acceptCookies = function() {
        setCookie(CONSENT_COOKIE, 'accepted', CONSENT_DURATION);
        applyConsent('accepted');
        hideBanner();
    };
    
    // Rechazar cookies no esenciales
    window.rejectCookies = function() {
        setCookie(CONSENT_COOKIE, 'rejected', CONSENT_DURATION);
        applyConsent('rejected');
        hideBanner();
    };
    
    // Aplicar consentimiento
    function applyConsent(consent) {
        if (consent === 'accepted') {
            // Aquí puedes activar Google Analytics, etc.
            // enableAnalytics();
        } else {
            // Bloquear cookies no esenciales
            // disableAnalytics();
        }
    }
    
    // Obtener cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }
    
    // Establecer cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }
    
    // Ejecutar al cargar la página
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkConsent);
    } else {
        checkConsent();
    }
})();
</script>
