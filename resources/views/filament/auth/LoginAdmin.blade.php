<x-filament-panels::page.simple>
    <div class="w-full max-w-md mx-auto space-y-6">
        {{-- Form Login --}}
        <form wire:submit.prevent="authenticate" class="space-y-4">
            {{ $this->form }}

            {{-- 🔹 Tampilkan pesan error global (email/password/captcha) --}}
            @if ($errors->any())
                <div class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3 space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Tombol Sign in --}}
            <x-filament::button
                type="submit"
                class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-md py-2">
                Sign in
            </x-filament::button>
        </form>

        {{-- Tombol Login Penduduk --}}
        <div class="text-center">
            <a href="{{ url('/penduduk/login') }}"
               class="block w-full border border-amber-600 text-amber-600 hover:bg-amber-50 font-semibold rounded-md py-2 transition">
                Login Penduduk
            </a>
        </div>
    </div>
</x-filament-panels::page.simple>
