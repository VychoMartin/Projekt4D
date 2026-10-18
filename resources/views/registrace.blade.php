<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="auth">
    
    <div class="container registrace">

    <h1>Registrace</h1>

    <form name="registrace"
          method="POST"
          action="{{ route('registrace.store') }}"
          >
        @csrf

        <div class="input-group">
    <label>E-mail</label>
    <input type="text" name="email" value="{{ old('email') }}" placeholder="Např. jan.novak@gmail.com" >
    @error('email')
        <div style="color:red">{{ $message }}</div>
    @enderror
</div>
<div class="pole">
        <div class="input-group">
            <label>Heslo</label>
            <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Min. 8 znaků">
        <button type="button" class="toggle-password" data-target="password" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>
             @error('password')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>

        <div class="input-group">
            <label>Heslo znovu</label>
            <div class="password-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Znovu zadejte heslo">
        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>
            
             @error('password_confirmation')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>
        </div>
<div class="pole">
  
        <div class="input-group">
            <label>Jméno</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Např. Jan">
             @error('name')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>
        <div class="input-group">
            <label>Příjmení</label>
            <input type="text" name="surname" value="{{ old('surname') }}" placeholder="Např. Novák">
             @error('surname')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>
        
</div>
        <div class="input-group">
            <label>Telefon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Např. +420777123456">
                 @error('phone')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>
       

        <input type="submit"
               value="Registrovat se"
               class="btn btn-primary">

                <a href="{{ route("prihlaseni") }}" class="login-link">
                    <button type="button" class="btn btn-secondary">
                        Už mám účet
                    </button>
                </a>
   
    </form>

</div>
    
    
</body>
</html>