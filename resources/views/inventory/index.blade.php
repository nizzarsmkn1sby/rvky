<x-app-layout>
    <x-slot name="header">Asset Registry</x-slot>

    <div x-data="inventorySystem()" class="space-y-10">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div class="space-y-2">
                <h2 class="font-display font-black text-4xl text-white tracking-tighter uppercase leading-none">Asset <span class="gold-text">Intel</span></h2>
                <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.5em]">Inventory Intelligence System • Operational</p>
            </div>
            
            <div class="flex items-center gap-4 w-full md:w-auto">
                <button @click="showManageCategories = true" class="flex-1 md:flex-none px-8 py-4 bg-obsidian-900 border border-white/5 text-white/40 text-[10px] font-black rounded-2xl hover:text-gold-premium hover:border-gold-premium/20 transition-all uppercase tracking-widest flex items-center justify-center gap-3 group">
                    <i data-lucide="layers" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                    Sectors
                </button>
                <button @click="showAddProduct = true" class="flex-1 md:flex-none px-8 py-4 gold-gradient text-obsidian-950 text-[10px] font-black rounded-2xl hover:scale-105 transition-all uppercase tracking-widest flex items-center justify-center gap-3 shadow-2xl shadow-gold-premium/20">
                    <i data-lucide="plus" class="w-5 h-5 stroke-[3px]"></i>
                    New Entity
                </button>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="flex flex-col lg:flex-row gap-6 items-stretch">
            <div class="relative flex-1 group">
                <div class="absolute inset-0 bg-gold-premium/5 rounded-2xl blur-lg opacity-0 group-focus-within:opacity-100 transition-opacity"></div>
                <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20 group-focus-within:text-gold-premium transition-colors"></i>
                <input type="text" x-model="search" placeholder="Scan infrastructure signature..." class="relative w-full bg-obsidian-900 border border-white/5 rounded-2xl py-4 pl-14 pr-6 text-sm text-white focus:border-gold-premium/50 focus:bg-obsidian-950 transition-all outline-none font-medium placeholder:text-white/10">
            </div>
            
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-2 lg:pb-0">
                <button @click="selectedCategory = 'all'" :class="selectedCategory === 'all' ? 'gold-gradient text-obsidian-950' : 'bg-obsidian-900 text-white/40 border-white/5'" class="px-8 py-4 text-[10px] font-black rounded-xl border uppercase tracking-widest whitespace-nowrap transition-all">All Sectors</button>
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="selectedCategory = cat.id" :class="selectedCategory === cat.id ? 'gold-gradient text-obsidian-950' : 'bg-obsidian-900 text-white/40 border-white/5'" class="px-8 py-4 text-[10px] font-black rounded-xl border uppercase tracking-widest whitespace-nowrap transition-all" x-text="cat.name"></button>
                </template>
            </div>
        </div>

        <!-- Asset Table -->
        <div class="glass-card rounded-[2.5rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-obsidian-900/50 border-b border-white/5">
                        <tr class="text-[9px] font-black uppercase tracking-[0.5em] text-white/20">
                            <th class="px-8 py-6">Entity</th>
                            <th class="px-8 py-6">Sector</th>
                            <th class="px-8 py-6">Valuation</th>
                            <th class="px-8 py-6">Status</th>
                            <th class="px-8 py-6 text-right">Protocol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.03]">
                        <template x-for="product in filteredProducts" :key="product.id">
                            <tr class="group hover:bg-white/[0.01] transition-all">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 rounded-2xl bg-obsidian-950 border border-white/5 flex items-center justify-center overflow-hidden group-hover:border-gold-premium/30 transition-all">
                                            <template x-if="product.image">
                                                <img :src="'/storage/' + product.image" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!product.image">
                                                <i data-lucide="shield" class="w-6 h-6 text-white/10 group-hover:text-gold-premium/40 transition-colors"></i>
                                            </template>
                                        </div>
                                        <div>
                                            <p class="font-display font-black text-lg text-white group-hover:text-gold-premium transition-colors" x-text="product.name"></p>
                                            <p class="text-[9px] text-white/20 font-black uppercase tracking-widest">ID: <span x-text="product.id.toString().padStart(4, '0')"></span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 bg-white/5 rounded-full text-[9px] font-black uppercase tracking-widest text-white/40 group-hover:text-white transition-colors" x-text="product.category.name"></span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xl font-display font-black text-white" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-1.5 w-16 bg-obsidian-950 rounded-full overflow-hidden border border-white/5">
                                            <div class="h-full transition-all duration-1000" 
                                                 :class="product.stock < 10 ? 'bg-red-500' : 'bg-gold-premium'"
                                                 :style="'width: ' + Math.min(100, (product.stock/50)*100) + '%'"></div>
                                        </div>
                                        <span class="text-lg font-display font-black" :class="product.stock < 10 ? 'text-red-500' : 'text-white'" x-text="product.stock"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                        <button @click="restockData.product_id = product.id; showRestock = true" 
                                                class="p-3 bg-gold-premium/10 border border-gold-premium/20 rounded-xl text-gold-premium hover:bg-gold-premium hover:text-obsidian-950 transition-all">
                                            <i data-lucide="plus-circle" class="w-5 h-5"></i>
                                        </button>
                                        <button @click="editProduct(product)" 
                                                class="p-3 bg-white/5 border border-white/5 rounded-xl text-white/40 hover:text-white transition-all">
                                            <i data-lucide="edit" class="w-5 h-5"></i>
                                        </button>
                                        <button @click="deleteId = product.id; showDelete = true" 
                                                class="p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Success/Error Notifications -->
        @if(session('success'))
            <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                 class="fixed bottom-10 right-10 z-[200] glass-card p-6 rounded-3xl border-emerald-500/20 text-emerald-400 flex items-center gap-4 animate-in slide-in-from-right-10">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
                <span class="font-black uppercase tracking-widest text-[10px]">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Add Product Modal -->
        <div x-show="showAddProduct" class="fixed inset-0 z-[150] flex items-center justify-center p-6 bg-obsidian-950/90 backdrop-blur-xl" x-cloak x-transition.opacity>
            <div @click.away="showAddProduct = false" class="glass-card p-10 rounded-[3rem] max-w-md w-full space-y-8 border-white/10 shadow-2xl">
                <div>
                    <h3 class="text-3xl font-display font-black uppercase text-white">New <span class="gold-text">Entity</span></h3>
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mt-2">Initialize new asset in registry.</p>
                </div>
                <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div x-data="{ addNewCategory: false }">
                            <div class="flex justify-between items-center ml-4 mb-2">
                                <label class="text-[9px] font-black uppercase tracking-widest text-white/40 block">Sector</label>
                                <button type="button" @click="addNewCategory = !addNewCategory" class="text-[8px] font-black uppercase tracking-widest text-gold-premium hover:underline" x-text="addNewCategory ? 'Select Existing' : '+ New Sector'"></button>
                            </div>
                            
                            <div x-show="!addNewCategory">
                                <select name="category_id" class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all">
                                    <option value="">-- Select Sector --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div x-show="addNewCategory" x-cloak>
                                <input type="text" name="new_category_name" class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all" placeholder="Enter new sector name...">
                            </div>
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Entity Name</label>
                            <input type="text" name="name" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all" placeholder="Enter entity designation...">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Valuation (IDR)</label>
                                <input type="number" name="price" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all" placeholder="0">
                            </div>
                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Initial Stock</label>
                                <input type="number" name="stock" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Visual Hash (Image)</label>
                            <input type="file" name="image" class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-xs text-white/40 file:hidden">
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" @click="showAddProduct = false" class="flex-1 py-5 bg-white/5 text-white/40 font-black rounded-2xl text-[10px] uppercase tracking-widest hover:text-white transition-all">Abort</button>
                        <button type="submit" class="flex-1 py-5 gold-gradient text-obsidian-950 font-black rounded-2xl text-[10px] uppercase tracking-widest shadow-xl shadow-gold-premium/20">Execute</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div x-show="showEditProduct" class="fixed inset-0 z-[150] flex items-center justify-center p-6 bg-obsidian-950/90 backdrop-blur-xl" x-cloak x-transition.opacity>
            <div @click.away="showEditProduct = false" class="glass-card p-10 rounded-[3rem] max-w-md w-full space-y-8 border-white/10 shadow-2xl">
                <div>
                    <h3 class="text-3xl font-display font-black uppercase text-white">Modify <span class="gold-text">Entity</span></h3>
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mt-2">Update asset parameters.</p>
                </div>
                <form :action="'/inventory/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Sector</label>
                            <select name="category_id" x-model="editData.category_id" class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Entity Name</label>
                            <input type="text" name="name" x-model="editData.name" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Valuation (IDR)</label>
                                <input type="number" name="price" x-model="editData.price" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all">
                            </div>
                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-white/40 ml-4 mb-2 block">Current Stock</label>
                                <input type="number" name="stock" x-model="editData.stock" required class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-sm text-white focus:border-gold-premium/40 outline-none transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" @click="showEditProduct = false" class="flex-1 py-5 bg-white/5 text-white/40 font-black rounded-2xl text-[10px] uppercase tracking-widest hover:text-white transition-all">Abort</button>
                        <button type="submit" class="flex-1 py-5 gold-gradient text-obsidian-950 font-black rounded-2xl text-[10px] uppercase tracking-widest shadow-xl shadow-gold-premium/20">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Restock/Adjust Modal -->
        <div x-show="showRestock" class="fixed inset-0 z-[150] flex items-center justify-center p-6 bg-obsidian-950/90 backdrop-blur-xl" x-cloak x-transition.opacity>
            <div @click.away="showRestock = false" class="glass-card p-10 rounded-[3rem] max-w-sm w-full space-y-8 border-gold-premium/20 shadow-2xl">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gold-premium/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="refresh-cw" class="w-8 h-8 text-gold-premium"></i>
                    </div>
                    <h3 class="text-2xl font-display font-black uppercase text-white">Stock <span class="gold-text">Adjustment</span></h3>
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mt-2">Modify inventory quantity.</p>
                </div>
                <form action="{{ route('inventory.restock') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" x-model="restockData.product_id">
                    <div>
                        <label class="text-[9px] font-black uppercase tracking-widest text-white/40 text-center block mb-4">Amount to Add/Subtract</label>
                        <div class="flex items-center justify-center gap-6">
                            <button type="button" @click="restockData.qty--" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-red-500 transition-all"><i data-lucide="minus"></i></button>
                            <input type="number" name="qty" x-model="restockData.qty" class="w-24 bg-transparent border-none text-center text-4xl font-display font-black text-white focus:ring-0">
                            <button type="button" @click="restockData.qty++" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-gold-premium hover:text-obsidian-950 transition-all"><i data-lucide="plus"></i></button>
                        </div>
                        <p class="text-[8px] text-white/10 text-center mt-4 italic uppercase">Negative values will reduce stock.</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="showRestock = false" class="flex-1 py-4 bg-white/5 text-white/40 font-black rounded-2xl text-[10px] uppercase tracking-widest">Cancel</button>
                        <button type="submit" class="flex-1 py-4 gold-gradient text-obsidian-950 font-black rounded-2xl text-[10px] uppercase tracking-widest">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center p-6 bg-obsidian-950/90 backdrop-blur-xl" x-cloak x-transition.opacity>
            <div @click.away="showDelete = false" class="glass-card p-10 rounded-[3rem] max-w-sm w-full text-center space-y-8 border-red-500/20 shadow-2xl">
                <div class="w-20 h-20 bg-red-500/10 rounded-3xl flex items-center justify-center mx-auto text-red-500">
                    <i data-lucide="alert-triangle" class="w-10 h-10"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-display font-black uppercase text-white">Terminate <span class="text-red-500">Entity</span></h3>
                    <p class="text-white/20 text-[10px] font-bold uppercase tracking-widest mt-2">This action is irreversible.</p>
                </div>
                <form :action="'/inventory/' + deleteId" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" @click="showDelete = false" class="flex-1 py-4 bg-white/5 text-white/40 font-black rounded-2xl text-[10px] uppercase tracking-widest">Abort</button>
                        <button type="submit" class="flex-1 py-4 bg-red-500 text-white font-black rounded-2xl text-[10px] uppercase tracking-widest">Destroy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function inventorySystem() {
            return {
                products: @json($products),
                categories: @json($categories),
                search: '',
                selectedCategory: 'all',
                showAddProduct: false,
                showEditProduct: false,
                showRestock: false,
                showDelete: false,
                deleteId: null,
                editData: { id: '', name: '', price: '', stock: '', category_id: '' },
                restockData: { product_id: '', qty: 1 },
                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchCategory = this.selectedCategory === 'all' || p.category_id === this.selectedCategory;
                        return matchSearch && matchCategory;
                    });
                },
                editProduct(product) {
                    this.editData = { ...product };
                    this.showEditProduct = true;
                }
            }
        }
    </script>
</x-app-layout>
