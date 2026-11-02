@extends('layouts.default')
@vite('resources/css/app.css')
@vite('resources/css/main.css')
@vite('resources/js/app.js')
@section('header')
   
@endsection


@section('maincontent')
<h1>Správa uživatelů</h1>

    <div class="users-table-wrap">
    <table class="users-table">
        <thead>
            <tr>
                <th>Jméno</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>Role</th>
                <th>Specializace</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
    <tr>
        <td><i class="bi bi-person-circle"></i> {{ $user->name }} {{ $user->surname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>

        @if($user->id === auth()->id())
            <td><span class="badge badge-{{ $user->role }}">{{ $user->role_label }}</span></td>
            <td>–</td>
            <td></td>
        @else
            <td>
                <select name="role" form="form-{{ $user->id }}" class="role-select">
                    <option value="user"    @selected($user->role === 'user')>Uživatel</option>
                    <option value="technik" @selected($user->role === 'technik')>Technik</option>
                    <option value="spravce" @selected($user->role === 'spravce')>Správce</option>
                </select>
            </td>

            <td>
                <input type="text" name="specializace" form="form-{{ $user->id }}"
                       class="specializace-input"
                       value="{{ $user->specializace }}"
                       placeholder="Specializace" required>
            </td>

            <td>
                <div class="akce">
                    <form id="form-{{ $user->id }}" method="POST" action="{{ route('sprava-uzivatelu.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn-save">Uložit</button>
                    </form>

                    <form method="POST" action="{{ route('sprava-uzivatelu.destroy', $user) }}"
                         data-confirm="Opravdu chcete smazat uživatele {{ $user->name }} {{ $user->surname }}?"
                         data-confirm-button="Smazat účet">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="bi bi-trash"></i> Odstranit
                        </button>
                    </form>
                </div>
            </td>
        @endif
    </tr>
@empty
    <tr><td colspan="6">Žádní uživatelé.</td></tr>
@endforelse
        </tbody>
    </table>
</div>
@endsection
    @section('footer')
    @endsection