<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RVKY POS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                            display: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            'obsidian': '#050505',
                            'gold': {
                                premium: '#d4af37',
                                glow: '#ffdf00',
                            }
                        }
                    }
                }
            }
        </script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <style>
            [x-cloak] { display: none !important; }
            .glass-panel {
                background: rgba(15, 15, 15, 0.6);
                backdrop-filter: blur(40px);
                border: 1px solid rgba(212, 175, 55, 0.1);
            }
            body { zoom: 0.8; }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#050505] text-white selection:bg-gold-premium selection:text-black overflow-x-hidden">
        <!-- Background Glows -->
        <div class="fixed inset-0 pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] bg-gold-premium/5 rounded-full blur-[150px]"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] bg-gold-premium/5 rounded-full blur-[150px]"></div>
        </div>

        <div class="min-h-screen relative z-10 flex flex-col items-center justify-center p-6">
            <div class="w-full max-w-lg">
                <div class="flex flex-col items-center mb-16">
                    <a href="/" class="flex flex-col items-center gap-6 group">
                        <div class="w-20 h-20 bg-gradient-to-br from-gold-300 to-gold-premium rounded-[2rem] flex items-center justify-center shadow-2xl transition-transform duration-700 group-hover:scale-110">
                            <i data-lucide="shield-check" class="text-black w-10 h-10"></i>
                        </div>
                        <div class="text-center">
                            <span class="font-display font-black text-4xl tracking-tighter uppercase leading-none block">RVKY</span>
                            <span class="text-[10px] text-gold-premium font-bold uppercase tracking-[0.5em] mt-2 block">Golden Obsidian Node</span>
                        </div>
                    </a>
                </div>

                <div class="glass-panel p-12 md:p-16 rounded-[4rem] shadow-2xl animate-in zoom-in-95 duration-700">
                    {{ $slot }}
                </div>

                <div class="mt-12 text-center opacity-20">
                    <p class="text-[10px] font-black text-white uppercase tracking-[0.5em]">Auth Protocol • Secure Session</p>
                </div>
            </div>
        </div>
        <script>lucide.createIcons();</script>
    </body>
</html>
