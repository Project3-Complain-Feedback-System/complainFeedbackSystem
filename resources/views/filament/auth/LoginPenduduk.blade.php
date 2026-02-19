<x-filament-panels::page.simple>
    <div class="w-full max-w-md mx-auto space-y-6">
        {{-- Form Login --}}
        <form wire:submit.prevent="authenticate" class="space-y-4">
            {{ $this->form }}

            {{-- Tampilkan pesan error global --}}
            @if ($errors->any())
                <div class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3 space-y-1">
                    @foreach ($errors->unique() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Tombol Login --}}
            <x-filament::button
                type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-md py-2">
                Login Penduduk
            </x-filament::button>
        </form>

        {{-- Tombol Login Admin --}}
        <div class="text-center">
            <a href="{{ url('/admin/login') }}"
               class="block w-full border border-emerald-600 text-emerald-600 hover:bg-emerald-50 font-semibold rounded-md py-2 transition">
                Login Admin
            </a>
        </div>
    </div>
</x-filament-panels::page.simple>
