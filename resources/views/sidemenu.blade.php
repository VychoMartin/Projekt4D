
    <a href="{{ url('/home') }}">Domů</a>
    <a href="{{ url('/contact') }}">Kontakty</a>


    <form method="POST" action="{{ route('odhlaseni') }}">
        @csrf
        <button type="submit">Odhlásit se</button>
    </form>
