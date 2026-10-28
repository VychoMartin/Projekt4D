
    <a href="{{ url('/home') }}">Domů</a>
    <a href="{{ url('/profile') }}"><i class="bi bi-person-circle"></i> Můj profil</a>
    <a href="{{ url('/contact') }}"><i class="bi bi-telephone"></i>Kontakty</a>
    


    <form method="POST" action="{{ route('odhlaseni') }}">
        @csrf
        <button type="submit">Odhlásit se</button>
    </form>
