@extends('layouts.default')
@vite(['resources/css/main.css', 'resources/css/app.css', 'resources/js/app.js'])
@section('header')
@endsection

@section('maincontent')
@php
    $roleBadge = [
        'spravce' => 'bg-[#1f2a44] text-white',
        'technik' => 'bg-blue-100 text-blue-700',
        'user'    => 'bg-slate-100 text-slate-600',
    ];
    $avatarColor = [
        'spravce' => 'bg-[#1f2a44] text-white',
        'technik' => 'bg-blue-500 text-white',
        'user'    => 'bg-slate-300 text-slate-700',
    ];
    $counts = [
        'all'     => $users->count(),
        'spravce' => $users->where('role', 'spravce')->count(),
        'technik' => $users->where('role', 'technik')->count(),
        'user'    => $users->where('role', 'user')->count(),
    ];
@endphp

<div class="mx-auto w-full max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

    {{-- HLAVIČKA --}}
    <div class="mb-8">
        <h1 class="text-left text-3xl font-semibold tracking-tight text-[#1f2a44] sm:text-4xl">Správa uživatelů</h1>
        <p class="mt-2 text-slate-500">Měňte role, přiřazujte specializace technikům a odebírejte účty.</p>
    </div>

    {{-- STATISTIKY --}}
    <div class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach([
            ['Celkem uživatelů', $counts['all'],     'bi-people-fill',      'bg-slate-100 text-slate-600'],
            ['Správci',          $counts['spravce'], 'bi-shield-lock-fill', 'bg-[#1f2a44] text-white'],
            ['Technici',         $counts['technik'], 'bi-tools',            'bg-blue-100 text-blue-600'],
            ['Uživatelé',        $counts['user'],    'bi-person-fill',      'bg-emerald-100 text-emerald-600'],
        ] as [$label, $value, $icon, $iconStyle])
            <div class="flex items-center gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200 sm:p-5">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl text-xl {{ $iconStyle }}">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-2xl font-semibold leading-none text-[#1f2a44]">{{ $value }}</p>
                    <p class="mt-1 truncate text-sm text-slate-500">{{ $label }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- SEZNAM --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

        {{-- nástroje: vyhledávání + filtr --}}
        <div class="flex flex-col gap-3 border-b border-slate-200 p-4 md:flex-row md:items-center md:justify-between">
            <div class="relative w-full md:max-w-sm">
                <i class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input id="user-search" type="search" placeholder="Hledat jméno, e-mail nebo telefon…"
                       class="w-full rounded-lg border border-slate-300 bg-white py-2 pl-10 pr-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#4facfe] focus:ring-2 focus:ring-[#4facfe]/40 focus:outline-none">
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach(['all' => 'Vše', 'spravce' => 'Správci', 'technik' => 'Technici', 'user' => 'Uživatelé'] as $key => $label)
                    <button type="button" data-filter="{{ $key }}" data-active="{{ $key === 'all' ? 'true' : 'false' }}"
                            class="cursor-pointer rounded-full bg-slate-100 px-3.5 py-1.5 text-sm font-medium text-slate-600 transition hover:bg-slate-200 data-[active=true]:bg-[#1f2a44] data-[active=true]:text-white">
                        {{ $label }}
                        <span class="ml-1 opacity-60">{{ $counts[$key] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- záhlaví sloupců (jen od md) --}}
        <div class="hidden grid-cols-[2.2fr_1.2fr_1fr_1.3fr_auto] gap-6 border-b border-slate-200 bg-slate-50 px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 md:grid">
            <span>Uživatel</span>
            <span>Telefon</span>
            <span>Role</span>
            <span>Specializace</span>
            <span class="w-[190px]">Akce</span>
        </div>

        {{-- řádky --}}
        <div class="divide-y divide-slate-100">
            @forelse($users as $user)
                @php
                    $isSelf   = $user->id === auth()->id();
                    $initials = mb_strtoupper(mb_substr($user->name, 0, 1) . mb_substr($user->surname, 0, 1));
                    $search   = mb_strtolower($user->name . ' ' . $user->surname . ' ' . $user->email . ' ' . $user->phone);
                @endphp

                <div data-user-row data-role="{{ $user->role }}" data-search="{{ $search }}"
                     class="grid grid-cols-1 gap-4 px-5 py-5 transition hover:bg-slate-50 md:grid-cols-[2.2fr_1.2fr_1fr_1.3fr_auto] md:items-center md:gap-6 md:px-6 {{ $isSelf ? 'bg-blue-50/40' : '' }}">

                    {{-- uživatel --}}
                    <div class="flex min-w-0 items-center gap-4">
                        <div class="flex size-11 shrink-0 items-center justify-center rounded-full text-sm font-semibold {{ $avatarColor[$user->role] ?? $avatarColor['user'] }}">
                            {{ $initials }}
                        </div>
                        <div class="min-w-0">
                            <p class="flex flex-wrap items-center gap-2 font-semibold text-[#1f2a44]">
                                {{ $user->name }} {{ $user->surname }}
                                @if($isSelf)
                                    <span class="rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">To jste vy</span>
                                @endif
                            </p>
                            <p class="truncate text-sm text-slate-500">{{ $user->email }}</p>
                        </div>
                    </div>

                    {{-- telefon --}}
                    <div class="text-sm text-slate-700">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-400 md:hidden">Telefon</span>
                        <a href="tel:{{ preg_replace('/\s+/', '', $user->phone) }}" class="hover:text-[#1f2a44] hover:underline">
                            {{ $user->phone }}
                        </a>
                    </div>

                    @if($isSelf)
                        {{-- vlastní řádek: jen zobrazit --}}
                        <div>
                            <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-400 md:hidden">Role</span>
                            <span class="inline-block rounded-full px-3 py-1 text-sm font-medium {{ $roleBadge[$user->role] ?? $roleBadge['user'] }}">
                                {{ $user->role_label }}
                            </span>
                        </div>
                        <div class="text-sm text-slate-400">
                            <span class="mb-1 block text-xs font-semibold uppercase tracking-wider md:hidden">Specializace</span>
                            –
                        </div>
                        <div class="hidden w-[190px] text-sm text-slate-400 md:block">Vlastní účet upravte v profilu</div>
                    @else
                        {{-- role --}}
                        <div>
                            <label for="role-{{ $user->id }}" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-400 md:hidden">Role</label>
                            <select id="role-{{ $user->id }}" name="role" form="form-{{ $user->id }}"
                                    data-role-select data-initial="{{ $user->role }}"
                                    class="w-full cursor-pointer rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#4facfe] focus:ring-2 focus:ring-[#4facfe]/40 focus:outline-none">
                                <option value="user"    @selected($user->role === 'user')>Uživatel</option>
                                <option value="technik" @selected($user->role === 'technik')>Technik</option>
                                <option value="spravce" @selected($user->role === 'spravce')>Správce</option>
                            </select>
                        </div>

                        {{-- specializace (aktivní jen u technika) --}}
                        <div>
                            <label for="spec-{{ $user->id }}" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-400 md:hidden">Specializace</label>
                            <input id="spec-{{ $user->id }}" type="text" name="specializace" form="form-{{ $user->id }}"
                                   data-spec-input data-initial="{{ $user->specializace }}"
                                   value="{{ $user->specializace }}"
                                   placeholder="Např. Elektrikář"
                                   class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#4facfe] focus:ring-2 focus:ring-[#4facfe]/40 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400">
                        </div>

                        {{-- akce --}}
                        <div class="flex items-center gap-2 md:w-[190px]">
                            <form id="form-{{ $user->id }}" method="POST" action="{{ route('sprava-uzivatelu.update', $user) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" data-save disabled
                                        class="inline-flex cursor-pointer items-center gap-1.5 rounded-lg bg-[#1f2a44] px-3.5 py-2 text-sm font-medium text-white transition hover:bg-[#2c3b5e] disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:bg-[#1f2a44]">
                                    <i class="bi bi-check2"></i> Uložit
                                </button>
                            </form>

                            <form method="POST" action="{{ route('sprava-uzivatelu.destroy', $user) }}"
                                  data-confirm="Opravdu chcete smazat uživatele {{ $user->name }} {{ $user->surname }}?"
                                  data-confirm-button="Smazat">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="group inline-flex cursor-pointer items-center gap-1.5 rounded-lg border border-red-300 px-3.5 py-2 text-sm font-medium text-red-600 transition hover:border-red-500 hover:bg-red-500 hover:text-white">
                                    <i class="bi bi-trash3"></i> Smazat
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="px-6 py-12 text-center text-slate-500">Žádní uživatelé.</div>
            @endforelse
        </div>

        {{-- prázdný výsledek hledání --}}
        <div id="users-empty" hidden class="px-6 py-12 text-center">
            <i class="bi bi-search text-3xl text-slate-300"></i>
            <p class="mt-3 font-medium text-slate-600">Nikdo neodpovídá hledání</p>
            <p class="text-sm text-slate-400">Zkuste jiný výraz nebo změňte filtr.</p>
        </div>
    </div>
</div>

<script>
(() => {
    const rows    = [...document.querySelectorAll('[data-user-row]')];
    const search  = document.getElementById('user-search');
    const filters = [...document.querySelectorAll('[data-filter]')];
    const empty   = document.getElementById('users-empty');
    let activeRole = 'all';

    // vyhledávání + filtr podle role
    const applyFilter = () => {
        const q = search.value.trim().toLowerCase();
        let visible = 0;

        rows.forEach(row => {
            const show = (activeRole === 'all' || row.dataset.role === activeRole)
                      && row.dataset.search.includes(q);
            row.hidden = !show;
            if (show) visible++;
        });

        empty.hidden = visible !== 0;
    };

    search.addEventListener('input', applyFilter);

    filters.forEach(btn => btn.addEventListener('click', () => {
        activeRole = btn.dataset.filter;
        filters.forEach(b => b.dataset.active = String(b === btn));
        applyFilter();
    }));

    // specializace jen u technika + tlačítko Uložit až po změně
    document.querySelectorAll('[data-role-select]').forEach(select => {
        const row   = select.closest('[data-user-row]');
        const input = row.querySelector('[data-spec-input]');
        const save  = row.querySelector('[data-save]');

        const sync = () => {
            const isTechnik = select.value === 'technik';
            input.disabled = !isTechnik;
            input.required = isTechnik;
            input.placeholder = isTechnik ? 'Např. Elektrikář' : '—';

            const changed = select.value !== select.dataset.initial
                         || input.value !== input.dataset.initial;
            save.disabled = !changed;
        };

        select.addEventListener('change', sync);
        input.addEventListener('input', sync);
        sync();
    });
})();
</script>
@endsection

@section('footer')
@endsection