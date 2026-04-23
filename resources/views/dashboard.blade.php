<x-app-layout>
    <x-slot name="header">Command Node</x-slot>

    <div class="space-y-10">
        <!-- Hero Section -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-premium/10 border border-gold-premium/20 text-[9px] font-black text-gold-premium uppercase tracking-[0.3em]">
                    <span class="w-1.5 h-1.5 rounded-full bg-gold-premium animate-pulse"></span>
                    Identity Verified • Node 01
                </div>
                <h2 class="font-display font-black text-4xl md:text-5xl text-white tracking-tighter leading-none">
                    Welcome, <span class="gold-text">{{ explode(' ', Auth::user()->name)[0] }}</span>.
                </h2>
                <p class="text-white/30 text-xs md:text-sm font-bold uppercase tracking-[0.4em]">Core Architecture • Version 4.0.2 Stable</p>
            </div>
            
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <div class="flex-1 lg:flex-none px-8 py-5 glass-card rounded-[2rem] border-gold-premium/10">
                    <p class="text-[9px] text-gold-premium/50 uppercase tracking-[0.4em] font-black mb-1">Cycle Liquidity</p>
                    <p class="text-3xl font-display font-black text-white tracking-tight">Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('pos.index') }}" class="group w-20 h-20 gold-gradient text-obsidian-950 rounded-[2rem] flex items-center justify-center shadow-2xl transition-all hover:scale-110 active:scale-95">
                    <i data-lucide="zap" class="w-8 h-8 group-hover:fill-current"></i>
                </a>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-8">
            <!-- Large Stats Card -->
            <div class="md:col-span-4 glass-card rounded-[3rem] p-10 flex flex-col justify-between min-h-[400px] group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 gold-gradient opacity-[0.05] group-hover:opacity-[0.1] blur-[100px] transition-all duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-12">
                        <div class="w-16 h-16 bg-obsidian-900 border border-gold-premium/10 rounded-2xl flex items-center justify-center text-gold-premium shadow-xl">
                            <i data-lucide="trending-up" class="w-8 h-8"></i>
                        </div>
                        <span class="px-5 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-[9px] font-black text-emerald-400 uppercase tracking-widest">Efficiency 99.9%</span>
                    </div>
                    
                    <p class="text-white/20 text-[10px] font-black uppercase tracking-[0.5em] mb-3">Portfolio Volume (30D)</p>
                    <h3 class="text-4xl md:text-5xl font-display font-black tracking-tighter text-white mb-10">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-8 border-t border-white/5">
                        <div>
                            <p class="text-white/20 text-[9px] font-black uppercase tracking-[0.4em] mb-2">Processed</p>
                            <p class="text-2xl font-display font-black text-white">{{ $totalTransactions ?? 0 }} <span class="text-[10px] text-gold-premium/40 uppercase">Tx</span></p>
                        </div>
                        <div>
                            <p class="text-white/20 text-[9px] font-black uppercase tracking-[0.4em] mb-2">Volume</p>
                            <p class="text-2xl font-display font-black text-white">{{ $totalItemsSold ?? 0 }} <span class="text-[10px] text-gold-premium/40 uppercase">Qty</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Control -->
            <div class="md:col-span-2 glass-card rounded-[3rem] p-10 flex flex-col justify-between border-t-2 border-gold-premium/20">
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xl font-display font-black uppercase tracking-tight text-white">Stock Intel</h4>
                        <div class="w-12 h-12 gold-gradient rounded-2xl flex items-center justify-center text-obsidian-950 shadow-lg">
                            <i data-lucide="package" class="w-6 h-6"></i>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="p-6 rounded-2xl bg-obsidian-900 border border-white/5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                <span class="text-xs font-bold text-white/40 uppercase tracking-widest">Depleted</span>
                            </div>
                            <span class="text-2xl font-display font-black text-red-500">{{ $outOfStockCount ?? 0 }}</span>
                        </div>
                        <div class="p-6 rounded-2xl bg-obsidian-900 border border-white/5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-gold-premium"></div>
                                <span class="text-xs font-bold text-white/40 uppercase tracking-widest">Critical</span>
                            </div>
                            <span class="text-2xl font-display font-black text-gold-premium">{{ $lowStockCount ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('inventory.index') }}" class="w-full py-5 bg-white/5 hover:bg-gold-premium hover:text-obsidian-950 rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] text-center transition-all mt-8 border border-white/5">
                    Sync Inventory
                </a>
            </div>

            <!-- Transaction Logs -->
            <div class="md:col-span-6 space-y-8 mt-4">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-4">
                        <i data-lucide="activity" class="w-6 h-6 text-gold-premium"></i>
                        <h3 class="text-2xl font-display font-black uppercase tracking-tight text-white">Protocol Logs</h3>
                    </div>
                    <a href="{{ route('transactions.index') }}" class="text-[9px] font-black uppercase tracking-[0.4em] text-white/30 hover:text-gold-premium transition-colors">History Registry →</a>
                </div>

                <div class="glass-card rounded-[3rem] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-obsidian-900/50 border-b border-white/5">
                                <tr>
                                    <th class="px-10 py-6 text-[9px] font-black uppercase tracking-[0.5em] text-white/20">Signature</th>
                                    <th class="px-10 py-6 text-[9px] font-black uppercase tracking-[0.5em] text-white/20">Identity</th>
                                    <th class="px-10 py-6 text-[9px] font-black uppercase tracking-[0.5em] text-white/20">Value</th>
                                    <th class="px-10 py-6 text-[9px] font-black uppercase tracking-[0.5em] text-white/20 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/[0.03]">
                                @forelse($recentTransactions ?? [] as $tx)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-10 py-6">
                                        <span class="font-mono text-xs text-gold-premium/40 group-hover:text-gold-premium transition-colors">#{{ substr($tx->invoice_number, -6) }}</span>
                                    </td>
                                    <td class="px-10 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-white">{{ $tx->customer_name ?? 'Guest Node' }}</span>
                                            <span class="text-[9px] text-white/20 uppercase font-black">{{ $tx->created_at->format('M d, H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-10 py-6">
                                        <span class="text-lg font-display font-black text-white">Rp {{ number_format($tx->total_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-10 py-6 text-right">
                                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-[9px] font-black text-emerald-400 uppercase tracking-widest">Verified</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-10 py-20 text-center opacity-10">
                                        <p class="font-black uppercase tracking-widest">Zero Protocol Registry</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
