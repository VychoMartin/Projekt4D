
    <a href="{{ url('/home') }}"><i class="bi bi-house"></i>Domů</a>
    <a href="{{ url('/profile') }}"><i class="bi bi-person-circle"></i> Můj profil</a>
    <a href="{{ url('/contact') }}"><i class="bi bi-telephone"></i>Kontakty</a>
    @auth
    @if(auth()->user()->role === 'spravce')
        <a href="{{ route('sprava-uzivatelu') }}"><i class="bi bi-pencil"></i>Správa uživatelů</a>
    @endif
@endauth
    


    <form method="POST" action="{{ route('odhlaseni') }}">
        @csrf
        <button type="submit">Odhlásit se</button>
    </form>
