<x-app-layout>
    <x-slot name="header">Archive Registry</x-slot>

    <div class="space-y-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div class="space-y-2">
                <h2 class="font-display font-black text-6xl text-white tracking-tighter uppercase leading-none">History <span class="gold-text">Registry</span></h2>
                <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.5em]">Protocol Ledger Analytics • Verified</p>
            </div>
            <a href="{{ route('transactions.export') }}" class="w-full md:w-auto px-10 py-5 gold-gradient text-obsidian-950 text-[10px] font-black rounded-2xl hover:scale-105 transition-all uppercase tracking-widest flex items-center justify-center gap-3 shadow-2xl shadow-gold-premium/20">
                <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                Export Matrix
            </a>
        </div>

        <!-- Ledger Table -->
        <div class="glass-card rounded-[3rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-obsidian-900/50 border-b border-white/5">
                        <tr class="text-[9px] font-black uppercase tracking-[0.5em] text-white/20">
                            <th class="px-10 py-8">Signature</th>
                            <th class="px-10 py-8">Chronos</th>
                            <th class="px-10 py-8">Operator</th>
                            <th class="px-10 py-8">Aggregate Value</th>
                            <th class="px-10 py-8 text-right">Protocol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.03]">
                        @forelse($transactions as $tr)
                        <tr class="group hover:bg-white/[0.01] transition-all">
                            <td class="px-10 py-8">
                                <span class="font-mono text-xs text-gold-premium/40 group-hover:text-gold-premium transition-colors">#{{ substr($tr->invoice_number, -8) }}</span>
                            </td>
                            <td class="px-10 py-8">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white tracking-tight">{{ $tr->created_at->format('M d, Y') }}</span>
                                    <span class="text-[9px] text-white/20 font-black uppercase tracking-widest">{{ $tr->created_at->format('H:i:s') }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-obsidian-800 border border-white/5 flex items-center justify-center text-[10px] font-black text-gold-premium shadow-lg">
                                        {{ strtoupper(substr($tr->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-bold text-white group-hover:text-gold-premium transition-colors">{{ $tr->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-8">
                                <span class="text-xl font-display font-black text-white">Rp {{ number_format($tr->total_price, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-10 py-8 text-right">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                    <a href="{{ route('transactions.receipt', $tr->id) }}" target="_blank" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gold-premium hover:text-obsidian-950 transition-all">
                                        <i data-lucide="printer" class="w-5 h-5"></i>
                                    </a>
                                    <button class="px-6 py-3 bg-obsidian-900 border border-white/5 rounded-xl text-[9px] font-black uppercase tracking-widest text-white/20 hover:text-white transition-all">Log Info</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-32 text-center opacity-10">
                                <div class="flex flex-col items-center">
                                    <i data-lucide="archive" class="w-16 h-16 mb-4"></i>
                                    <p class="font-black uppercase tracking-widest text-xs">Zero Records Archived</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
