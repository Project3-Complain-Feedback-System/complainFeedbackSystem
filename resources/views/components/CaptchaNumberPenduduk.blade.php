<div class="flex flex-col items-center space-y-2">
    {{-- Angka Captcha --}}
    <div class="text-center font-mono text-3xl font-bold tracking-widest bg-gray-100 py-2 px-6 rounded select-none shadow-sm">
        {{ session('captcha_value') }}
    </div>

    {{-- Tombol Refresh --}}
    <button
        type="button"
        wire:click="generateCaptcha"
        class="flex items-center text-sm text-amber-600 hover:text-amber-700 transition font-semibold"
    >
        <x-heroicon-o-arrow-path class="w-4 h-4 mr-1" />
        Refresh
    </button>
</div>
