<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RVKY POS • Golden Obsidian</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        'obsidian': {
                            950: '#030303',
                            900: '#0a0a0a',
                            800: '#141414',
                        },
                        'gold': {
                            500: '#f4ba18',
                            600: '#d9a110',
                            premium: '#d4af37',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #030303;
            color: #ffffff;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
            zoom: 0.8;
        }

        .font-display { font-family: 'Outfit', sans-serif; }

        .gold-gradient {
            background: linear-gradient(135deg, #f4ba18 0%, #d4af37 100%);
        }

        .gold-text {
            background: linear-gradient(135deg, #f4ba18 0%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-card {
            background: rgba(15, 15, 15, 0.4);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            border-color: rgba(212, 175, 55, 0.2);
            background: rgba(20, 20, 20, 0.6);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: rgba(212, 175, 55, 0.1);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: rgba(212, 175, 55, 0.3); }
    </style>
</head>
<body class="antialiased selection:bg-gold-premium/30 selection:text-gold-premium" 
      x-data="{ sidebarOpen: window.innerWidth > 1024, isMobile: window.innerWidth < 1024 }"
      x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 1024; if(!isMobile) sidebarOpen = true })">
    
    <div class="min-h-screen flex relative">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')

        <!-- Mobile Overlay -->
        <div x-show="isMobile && sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 transition-all duration-500 min-h-screen flex flex-col" 
              :class="!isMobile ? (sidebarOpen ? 'ml-64' : 'ml-24') : 'ml-0'">
            
            <!-- Unified Header -->
            <header class="h-20 flex items-center justify-between px-8 sticky top-0 z-30 bg-obsidian-950/40 backdrop-blur-xl border-b border-white/5">
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-xl bg-white/5 border border-white/5 text-white/40 hover:text-white transition-all">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <div class="flex flex-col">
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-gold-premium">RVKY GOLDEN SYSTEM</h2>
                        <div class="text-[10px] text-white/20 font-bold uppercase tracking-widest mt-1">
                            @if(isset($header)) {{ $header }} @else Protocol Active @endif
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="flex flex-col items-end hidden sm:flex">
                        <span class="text-xs font-bold text-white">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-white/20 uppercase tracking-widest">{{ Auth::user()->role ?? 'Operator' }}</span>
                    </div>
                    <div class="w-10 h-10 gold-gradient rounded-xl flex items-center justify-center text-obsidian-950 font-black shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 md:p-6 flex-1">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </div>

            <!-- Bottom Nav (Mobile Only) -->
            <div class="fixed bottom-6 left-6 right-6 h-16 bg-obsidian-900/90 backdrop-blur-3xl border border-white/10 rounded-3xl z-40 flex items-center justify-around px-2 lg:hidden shadow-2xl">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('dashboard') ? 'text-gold-premium' : 'text-white/20' }}">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                    <span class="text-[8px] font-bold uppercase tracking-widest">Dash</span>
                </a>
                <a href="{{ route('pos.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('pos.*') ? 'text-gold-premium' : 'text-white/20' }}">
                    <div class="w-12 h-12 -mt-10 bg-gold-premium rounded-2xl flex items-center justify-center text-black shadow-xl shadow-gold-premium/20">
                        <i data-lucide="zap" class="w-6 h-6"></i>
                    </div>
                    <span class="text-[8px] font-bold uppercase tracking-widest mt-1">POS</span>
                </a>
                <a href="{{ route('inventory.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('inventory.*') ? 'text-gold-premium' : 'text-white/20' }}">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    <span class="text-[8px] font-bold uppercase tracking-widest">Stock</span>
                </a>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
