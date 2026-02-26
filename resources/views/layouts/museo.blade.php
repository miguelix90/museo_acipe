<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Museo IA de ACIPE')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
          href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <style>
        body {
            font-family: Inter, "Noto Sans", sans-serif;
        }
    </style>
</head>
<body>
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-white group/design-root overflow-x-hidden" style='font-family: Inter, "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f4] px-10 py-3">
                <a href="{{ route('museo.home') }}" class="flex items-center gap-4 text-[#111418] hover:opacity-80 transition">
                    <div class="w-10 h-10">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo ACIPE" class="w-full h-full object-contain">
                    </div>
                    <h2 class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em]">Museo ACIPE</h2>
                </a>
                <div class="flex flex-1 justify-end gap-8">
                    <div class="flex items-center gap-9">
                        <a class="text-[#111418] text-sm font-medium leading-normal" href="{{ route('museo.exposiciones') }}">Exposiciones</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal" href="{{ route('museo.salas') }}">Salas</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal" href="{{ route('museo.libros') }}">Libros</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal" href="{{ route('museo.acerca') }}">Acerca de</a>
                    </div>
                    @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f2f4] text-[#111418] text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate">Panel Admin</span>
                    </a>
                    @endauth
                </div>
            </header>

            <!-- Content -->
            <div class="px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para imágenes -->
    <div id="imageModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-90 flex items-center justify-center p-4" onclick="closeModal()">
        <div class="relative max-w-7xl max-h-full">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300 z-10">
                &times;
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-screen object-contain">
            <p id="modalCaption" class="text-white text-center mt-4 text-lg"></p>
        </div>
    </div>

    <script>
        function openModal(imageSrc, caption) {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalCaption').textContent = caption || '';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
