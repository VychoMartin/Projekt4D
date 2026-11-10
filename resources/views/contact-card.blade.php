{{-- resources/views/contact-card.blade.php --}}
<article class="grid grid-cols-1 items-center gap-x-8 gap-y-4 rounded-xl border-2 border-gray-300 bg-[#1f2a44] px-6 py-5 text-lg text-[#b5bdc9] shadow-md transition duration-200 hover:-translate-y-0.5 hover:shadow-xl md:grid-cols-2 lg:grid-cols-[1.5fr_1.1fr_1.7fr_1fr] lg:px-8">

    <div class="flex items-center gap-3 border-b border-[#b5bdc9]/30 pb-4 text-2xl font-semibold text-white md:col-span-2 lg:col-span-1 lg:border-b-0 lg:border-r lg:pb-0 lg:pr-6">
        <i class="bi bi-person-circle text-4xl"></i>
        <span>{{ $user->name }} {{ $user->surname }}</span>
    </div>

    <div class="flex min-w-0 items-center gap-3">
        <i class="bi bi-telephone-fill text-2xl"></i>
        <a href="tel:{{ preg_replace('/\s+/', '', $user->phone) }}"
           class="transition hover:text-white hover:underline">{{ $user->phone }}</a>
    </div>

    <div class="flex min-w-0 items-center gap-3">
        <i class="bi bi-envelope-fill text-2xl"></i>
        <a href="mailto:{{ $user->email }}"
           class="break-all transition hover:text-white hover:underline">{{ $user->email }}</a>
    </div>

    <div class="flex items-center gap-3 {{ $showSpecializace ? '' : 'hidden lg:flex' }}">
        @if($showSpecializace && $user->specializace)
            <i class="bi bi-gear text-2xl"></i>
            <span>{{ $user->specializace }}</span>
        @endif
    </div>
</article>
