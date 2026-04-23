<x-guest-layout>
    <div class="space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-1000">
        <div class="text-center">
            <h2 class="text-5xl font-black tracking-tighter uppercase text-white leading-none mb-4">Identity</h2>
            <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em]">Node Authentication Required</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-8">
            @csrf

            <!-- Email Address -->
            <div class="space-y-3">
                <label for="email" class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-6">Access Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                    class="block w-full bg-white/5 border border-white/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:border-white/40 focus:bg-white/10 focus:ring-0 transition-all placeholder:text-white/5 tracking-wider"
                    placeholder="user@rvky.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-[10px] font-black uppercase tracking-widest ml-6" />
            </div>

            <!-- Password -->
            <div class="space-y-3">
                <div class="flex justify-between items-center px-6">
                    <label for="password" class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Access Code</label>
                    @if (Route::has('password.request'))
                        <a class="text-[9px] font-black text-white/10 hover:text-white uppercase tracking-[0.2em] transition-colors" href="{{ route('password.request') }}">
                            Recover
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full bg-white/5 border border-white/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:border-white/40 focus:bg-white/10 focus:ring-0 transition-all placeholder:text-white/5 tracking-wider"
                    placeholder="••••••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-[10px] font-black uppercase tracking-widest ml-6" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center px-6">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded-lg bg-white/5 border-white/20 text-white focus:ring-0 w-6 h-6 transition-all group-hover:border-white/40" name="remember">
                    <span class="ms-4 text-[10px] font-black text-white/30 uppercase tracking-[0.2em] group-hover:text-white/60 transition-colors">Persistent Session</span>
                </label>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-6 bg-white text-black font-black rounded-[2.5rem] hover:scale-[1.02] active:scale-[0.98] transition-all uppercase tracking-[0.4em] text-xs shadow-[0_20px_40px_rgba(255,255,255,0.1)]">
                    Authenticate
                </button>
            </div>

            <div class="text-center pt-4">
                <p class="text-[9px] font-black text-white/10 uppercase tracking-[0.3em]">
                    New Node? 
                    <a href="{{ route('register') }}" class="text-white hover:underline decoration-2 underline-offset-8">Initialize Account</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
