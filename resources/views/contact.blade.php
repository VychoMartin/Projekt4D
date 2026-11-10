@extends('layouts.default')
 @vite(['resources/css/main.css', 'resources/css/app.css', 'resources/js/app.js'])
@section('header')
@endsection
 
@section('maincontent')
<div class="mx-auto w-full max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="mb-10 text-center text-4xl font-semibold tracking-tight text-[#1f2a44] sm:text-5xl">
        Kontakty
    </h1>
 
    {{-- SPRÁVCI --}}
    <section class="mb-12">
        <h2 class="mb-5 flex items-center gap-3 text-2xl font-semibold text-[#1f2a44] sm:text-3xl">
            Správci
            <span class="rounded-full bg-[#1f2a44]/10 px-3 py-0.5 text-sm font-medium">{{ $spravci->count() }}</span>
        </h2>
 
        <div class="flex flex-col gap-4">
            @forelse($spravci as $spravce)
                @include('contact-card', ['user' => $spravce, 'showSpecializace' => false])
            @empty
                <p class="text-gray-500"><i class="bi bi-exclamation-circle"></i> Kontakt je momentálně nedostupný.</p>
            @endforelse
        </div>
    </section>
 
    {{-- TECHNICI --}}
    <section>
        <h2 class="mb-5 flex items-center gap-3 text-2xl font-semibold text-[#1f2a44] sm:text-3xl">
            Technici
            <span class="rounded-full bg-[#1f2a44]/10 px-3 py-0.5 text-sm font-medium">{{ $technici->count() }}</span>
        </h2>
 
        <div class="flex flex-col gap-4">
            @forelse($technici as $technik)
                @include('contact-card', ['user' => $technik, 'showSpecializace' => true])
            @empty
                <p class="text-gray-500"><i class="bi bi-exclamation-circle"></i> Kontakt je momentálně nedostupný.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
 
@section('footer')
@endsection
 