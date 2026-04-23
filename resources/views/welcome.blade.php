<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RVKY • Golden Obsidian Edition</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
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
            .glass-card {
                background: rgba(20, 20, 20, 0.4);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(212, 175, 55, 0.1);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glass-card:hover {
                background: rgba(212, 175, 55, 0.05);
                border-color: rgba(212, 175, 55, 0.3);
                transform: translateY(-5px);
            }
            .gold-gradient {
                background: linear-gradient(135deg, #fde68a 0%, #d4af37 50%, #92400e 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="antialiased bg-[#050505] text-white selection:bg-gold-premium selection:text-black overflow-x-hidden">
        <!-- Ambient Gold Effects -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] bg-gold-premium/5 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 right-0 w-[40%] h-[40%] bg-gold-premium/5 rounded-full blur-[150px]"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 px-6 py-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-8 py-5 glass-card rounded-[2rem] shadow-2xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gold-300 to-gold-premium rounded-2xl flex items-center justify-center shadow-lg">
                        <i data-lucide="shield-check" class="text-black w-7 h-7"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-display font-black text-2xl tracking-tighter uppercase leading-none">RVKY</span>
                        <span class="text-[8px] font-black text-gold-premium uppercase tracking-[0.4em] mt-1">Obsidian Node 01</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-gold-premium text-black text-[10px] font-black rounded-xl hover:scale-105 transition-all uppercase tracking-widest shadow-xl">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-white/40 hover:text-white uppercase tracking-widest transition-colors mr-6">Identity</a>
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-black text-[10px] font-black rounded-xl hover:scale-105 transition-all uppercase tracking-widest shadow-xl">Initialize</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative min-h-screen pt-20 flex flex-col items-center justify-center overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center z-10">
                <div class="space-y-12">
                    <div class="inline-flex items-center gap-4 px-6 py-3 rounded-full glass-card text-[10px] font-black uppercase tracking-[0.3em] text-gold-premium">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gold-premium opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-gold-premium"></span>
                        </span>
                        System Online • Obsidian Core Active
                    </div>
                    
                    <h1 class="text-[5rem] lg:text-[7.5rem] font-display font-black tracking-tighter leading-[0.85] uppercase">
                        Elite<br/>
                        <span class="gold-gradient">Commerce.</span>
                    </h1>
                    
                    <p class="text-lg text-white/30 max-w-xl leading-relaxed font-medium uppercase tracking-tight">
                        Experience the absolute pinnacle of retail intelligence. Engineered for those who command the market with precision and luxury.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-6 pt-6">
                        <a href="{{ route('login') }}" class="px-12 py-6 bg-gold-premium text-black font-black rounded-[2rem] hover:scale-105 transition-all uppercase tracking-[0.2em] text-sm shadow-xl text-center">
                            Launch Terminal
                        </a>
                        <div class="flex items-center gap-4 px-8 py-5 glass-card rounded-[2rem]">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-[0.2em]">Validated by Obsidian Node Network</span>
                        </div>
                    </div>
                </div>

                <!-- Graphic -->
                <div class="relative">
                    <div class="glass-card p-12 rounded-[4rem] relative z-20 overflow-hidden shadow-2xl">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gold-premium/10 rounded-full blur-[80px] -mr-32 -mt-32"></div>
                        <div class="flex justify-between items-center mb-12">
                            <div>
                                <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-2">Daily Revenue Index</p>
                                <h3 class="text-4xl font-display font-black tracking-tighter uppercase gold-gradient">Rp 12.8M</h3>
                            </div>
                            <div class="w-16 h-16 bg-gold-premium text-black rounded-3xl flex items-center justify-center">
                                <i data-lucide="zap" class="w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="space-y-6 opacity-40">
                            @for($i=0; $i<3; $i++)
                            <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-gold-premium rounded-full" style="width: {{ rand(40, 90) }}%"></div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-white/5 py-20 relative z-10 text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-white/20">&copy; 2026 RVKY GOLDEN OBSIDIAN SYSTEMS</p>
        </footer>

        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
