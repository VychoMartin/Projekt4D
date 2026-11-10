@php
    $spravce = \App\Models\User::where('role', 'spravce')
        ->orderBy('surname')
        ->orderBy('name')
        ->first();
@endphp

<div class="mt-12 bg-[#1f2a44] px-6 pb-4 pt-10 text-sm text-gray-300">

    {{-- Kontakt na správce --}}
    <div class="mx-auto mb-8 max-w-2xl text-center">
        <h3 class="mb-5 text-lg font-semibold text-white">
            <i class="bi bi-headset mr-1.5 text-blue-400"></i> Kontakt na správce
        </h3>

        @if($spravce)
            <ul class="flex flex-wrap justify-center gap-x-8 gap-y-3">
                <li class="flex items-center gap-2">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ $spravce->name }} {{ $spravce->surname }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:{{ preg_replace('/\s+/', '', $spravce->phone) }}"
                       class="transition hover:text-white hover:underline">
                        {{ $spravce->phone }}
                    </a>
                </li>
                <li class="flex items-center gap-2">
                    <i class="bi bi-envelope-fill"></i>
                    <a href="mailto:{{ $spravce->email }}"
                       class="transition hover:text-white hover:underline">
                        {{ $spravce->email }}
                    </a>
                </li>
            </ul>
        @else
            <p class="text-gray-400">
                <i class="bi bi-exclamation-circle"></i> Kontakt je momentálně nedostupný.
            </p>
        @endif
    </div>

    {{-- Spodní lišta --}}
    <div class="flex flex-col items-center gap-3 border-t border-gray-700 pt-4 text-xs sm:flex-row sm:justify-between sm:text-sm">
        <a href="#" class="inline-flex items-center gap-1.5 transition hover:text-white hover:underline">
            <i class="bi bi-file-earmark-text"></i> Terms of Service
        </a>

        <p class="text-center text-gray-400">&copy; 2026 Hlášení Poruch. Všechna práva vyhrazena.</p>

        <a href="#" class="inline-flex items-center gap-1.5 transition hover:text-white hover:underline">
            <i class="bi bi-shield-lock"></i> Privacy Policy
        </a>
    </div>
</div>