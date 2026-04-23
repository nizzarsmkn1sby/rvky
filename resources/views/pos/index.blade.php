<x-app-layout>
    <x-slot name="header">Terminal Node</x-slot>

    <div x-data="posSystem()" class="flex flex-col lg:flex-row gap-10">
        <!-- Products Section -->
        <div class="flex-1 space-y-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-1">
                    <h2 class="font-display font-black text-3xl text-white tracking-tighter uppercase leading-none">Catalog <span class="gold-text">Protocol</span></h2>
                    <p class="text-[9px] text-white/30 font-black uppercase tracking-[0.4em]">Asset Selection Matrix</p>
                </div>
                
                <div class="relative w-full md:w-[350px] group">
                    <div class="absolute inset-0 bg-gold-premium/5 rounded-2xl blur-lg opacity-0 group-focus-within:opacity-100 transition-opacity"></div>
                    <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20 group-focus-within:text-gold-premium transition-colors"></i>
                    <input type="text" x-model="search" placeholder="Search architecture..." 
                           class="relative w-full bg-obsidian-900 border border-white/5 rounded-2xl py-4 pl-14 pr-6 text-sm text-white focus:border-gold-premium/50 outline-none transition-all font-medium placeholder:text-white/10">
                </div>
            </div>

            <!-- Categories -->
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-2">
                <button @click="selectedCategory = 'all'" 
                        :class="selectedCategory === 'all' ? 'gold-gradient text-obsidian-950' : 'bg-obsidian-900 text-white/40 border-white/5 hover:text-white'"
                        class="px-8 py-3.5 text-[9px] font-black rounded-xl border transition-all uppercase tracking-widest whitespace-nowrap">
                    All Sectors
                </button>
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="selectedCategory = cat.id" 
                            :class="selectedCategory === cat.id ? 'gold-gradient text-obsidian-950' : 'bg-obsidian-900 text-white/40 border-white/5 hover:text-white'"
                            class="px-8 py-3.5 text-[9px] font-black rounded-xl border transition-all uppercase tracking-widest whitespace-nowrap"
                            x-text="cat.name"></button>
                </template>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                <template x-for="product in filteredProducts" :key="product.id">
                    <button @click="addToCart(product)" class="glass-card group p-4 rounded-[2.5rem] text-left relative overflow-hidden border-white/5">
                        <div class="aspect-square rounded-[1.8rem] bg-obsidian-950/50 overflow-hidden mb-5 relative group-hover:scale-[1.03] transition-transform duration-500">
                            <template x-if="product.image">
                                <img :src="'/storage/' + product.image" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!product.image">
                                <div class="w-full h-full flex items-center justify-center opacity-10 group-hover:opacity-30 transition-opacity">
                                    <i data-lucide="shield" class="w-12 h-12"></i>
                                </div>
                            </template>
                            
                            <!-- Premium Hover Effect -->
                            <div class="absolute inset-0 gold-gradient opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-6 group-hover:translate-y-0">
                                <div class="w-12 h-12 bg-white text-obsidian-950 rounded-2xl flex items-center justify-center shadow-2xl">
                                    <i data-lucide="plus" class="w-6 h-6 stroke-[3px]"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-2">
                            <h4 class="font-display font-black text-white truncate text-base group-hover:text-gold-premium transition-colors" x-text="product.name"></h4>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-[8px] text-white/20 uppercase tracking-widest font-black" x-text="product.category.name"></p>
                                <p class="font-display font-black text-sm text-gold-premium" x-text="formatPrice(product.price)"></p>
                            </div>
                        </div>
                        
                        <!-- Stock Status -->
                        <div class="absolute top-6 right-6">
                            <span :class="product.stock < 10 ? 'bg-red-500/20 text-red-400' : 'bg-white/5 text-white/40'" 
                                  class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-tighter backdrop-blur-md"
                                  x-text="product.stock + ' U'"></span>
                        </div>
                    </button>
                </template>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="w-full lg:w-[450px]">
            <div class="glass-card rounded-[3rem] p-8 flex flex-col h-[calc(100vh-140px)] sticky top-28 border-gold-premium/5">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-display font-black text-2xl uppercase tracking-tight text-white leading-none">Order <span class="gold-text">Queue</span></h3>
                        <p class="text-[8px] text-white/20 uppercase tracking-[0.4em] font-black mt-2">Active Node session</p>
                    </div>
                    <button @click="clearCart()" x-show="cart.length > 0" class="p-4 rounded-xl bg-red-500/10 text-red-500 border border-red-500/10 hover:bg-red-500 hover:text-white transition-all group">
                        <i data-lucide="trash-2" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                    </button>
                </div>

                <!-- Items -->
                <div class="flex-1 overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                    <template x-for="item in cart" :key="item.id">
                        <div class="flex items-center gap-4 bg-white/[0.02] p-4 rounded-3xl border border-white/5 group hover:border-gold-premium/10 transition-all">
                            <div class="w-12 h-12 gold-gradient rounded-xl flex items-center justify-center font-black text-obsidian-950 shadow-lg" x-text="item.qty"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-white truncate uppercase tracking-tight text-xs" x-text="item.name"></p>
                                <p class="text-[10px] text-white/20 font-black" x-text="formatPrice(item.price)"></p>
                            </div>
                                <div class="flex items-center gap-1.5 p-1 bg-white/5 rounded-2xl border border-white/10">
                                    <button @click="updateQty(item.id, -1)" 
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                        <i data-lucide="minus" class="w-4 h-4"></i>
                                    </button>
                                    <div class="px-2 text-xs font-black text-white" x-text="item.qty"></div>
                                    <button @click="updateQty(item.id, 1)" 
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-gold-premium/10 text-gold-premium hover:bg-gold-premium hover:text-obsidian-950 transition-all">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                    </button>
                                    <button @click="cart = cart.filter(i => i.id !== item.id)" 
                                            class="ml-2 w-8 h-8 flex items-center justify-center rounded-xl bg-white/5 text-white/20 hover:bg-red-500 hover:text-white transition-all">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="cart.length === 0">
                        <div class="h-full flex flex-col items-center justify-center opacity-5 py-20">
                            <i data-lucide="layers" class="w-16 h-16 mb-4"></i>
                            <p class="font-black text-[9px] uppercase tracking-widest">Queue Empty</p>
                        </div>
                    </template>
                </div>

                <!-- Footer -->
                <div class="mt-8 pt-8 border-t border-white/5 space-y-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-white/20">
                            <span>Base Liquid</span>
                            <span x-text="formatPrice(subtotal)"></span>
                        </div>
                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-white/20">
                            <span>Fee (10%)</span>
                            <span x-text="formatPrice(tax)"></span>
                        </div>
                        <div class="flex justify-between items-end pt-2">
                            <span class="font-display font-black text-2xl gold-text">TOTAL</span>
                            <span class="font-display font-black text-4xl text-white tracking-tighter" x-text="formatPrice(total)"></span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-white/10 font-display font-black italic">Rp</span>
                            <input type="number" x-model="payAmount" placeholder="Liquidity Input" 
                                   class="w-full bg-black/40 border border-white/5 rounded-[2rem] py-5 pl-14 pr-6 text-2xl font-display font-black text-white focus:border-gold-premium/40 outline-none transition-all placeholder:text-white/5">
                        </div>

                        <div x-show="changeAmount >= 0 && payAmount > 0" 
                             class="p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-2xl flex justify-between items-center animate-in slide-in-from-top-2 duration-300">
                            <span class="text-[9px] font-black text-emerald-400/40 uppercase tracking-widest">Exchange Change</span>
                            <span class="text-2xl font-display font-black text-emerald-400" x-text="formatPrice(changeAmount)"></span>
                        </div>

                        <button @click="checkout()" 
                                :disabled="cart.length === 0 || payAmount < total"
                                class="w-full py-6 gold-gradient text-obsidian-950 font-black rounded-[2rem] text-[10px] uppercase tracking-[0.4em] transition-all hover:scale-[1.02] active:scale-95 disabled:opacity-20 disabled:grayscale shadow-xl shadow-gold-premium/20">
                            Execute Linking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Portal Modal [Functionality Kept, Styling Updated] -->
    <div x-show="showSuccess" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-obsidian-950/95 backdrop-blur-3xl" x-cloak x-transition.opacity>
        <div class="glass-card p-12 rounded-[4rem] max-w-sm w-full text-center space-y-10 border-gold-premium/20 shadow-2xl">
            <div class="w-24 h-24 gold-gradient rounded-[2.5rem] flex items-center justify-center mx-auto shadow-2xl rotate-12">
                <i data-lucide="shield-check" class="w-12 h-12 text-obsidian-950 stroke-[3px]"></i>
            </div>
            <div>
                <h3 class="text-4xl font-display font-black tracking-tight uppercase text-white">Linked <span class="gold-text">Success</span></h3>
                <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mt-4">Transaction secured and broadcasted.</p>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <button @click="printReceipt()" class="w-full py-5 bg-white text-obsidian-950 font-black rounded-2xl flex items-center justify-center gap-3 hover:scale-105 transition-all text-[10px] uppercase tracking-widest shadow-xl">
                    <i data-lucide="printer" class="w-4 h-4"></i> Generate Struk
                </button>
                <button @click="resetPOS()" class="w-full py-5 bg-white/5 border border-white/5 text-white/40 font-black rounded-2xl hover:text-white transition-all text-[10px] uppercase tracking-widest">
                    Next Sequence
                </button>
            </div>
        </div>
    </div>

    <script>
        function posSystem() {
            return {
                products: @json($products),
                categories: @json($categories),
                search: '',
                selectedCategory: 'all',
                cart: [],
                payAmount: 0,
                showSuccess: false,
                lastTransactionId: null,
                get filteredProducts() {
                    return this.products.filter(p => {
                        const mSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const mCat = this.selectedCategory === 'all' || p.category_id === this.selectedCategory;
                        return mSearch && mCat;
                    });
                },
                get subtotal() { return this.cart.reduce((s, i) => s + (i.price * i.qty), 0); },
                get tax() { return this.subtotal * 0.1; },
                get total() { return this.subtotal + this.tax; },
                get changeAmount() { return this.payAmount - this.total; },
                addToCart(p) {
                    const i = this.cart.find(item => item.id === p.id);
                    if(i) i.qty++; else this.cart.push({id:p.id, name:p.name, price:p.price, qty:1});
                    setTimeout(() => lucide.createIcons(), 10);
                },
                updateQty(id, d) {
                    const i = this.cart.find(item => item.id === id);
                    if(i) { i.qty += d; if(i.qty <= 0) this.cart = this.cart.filter(item => item.id !== id); }
                    setTimeout(() => lucide.createIcons(), 10);
                },
                clearCart() { this.cart = []; },
                formatPrice(p) { return 'Rp ' + new Intl.NumberFormat('id-ID').format(p); },
                async checkout() {
                    try {
                        const r = await fetch('{{ route('pos.checkout') }}', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            body: JSON.stringify({cart: this.cart, pay: this.payAmount})
                        });
                        const d = await r.json();
                        if(r.ok) { this.lastTransactionId = d.transaction_id; this.showSuccess = true; this.printReceipt(); } else alert(d.message);
                    } catch(e) { alert('Linking failed'); }
                },
                resetPOS() { this.cart = []; this.payAmount = 0; this.showSuccess = false; this.lastTransactionId = null; },
                printReceipt() { 
                    if(this.lastTransactionId) {
                        window.open(`/transactions/${this.lastTransactionId}/receipt`, '_blank', 'width=400,height=600');
                        this.resetPOS();
                    }
                }
            }
        }
    </script>
</x-app-layout>
