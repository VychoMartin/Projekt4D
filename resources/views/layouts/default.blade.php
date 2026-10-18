<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    @vite('resources/js/app.js')

</head>

<body class="app">
    
<header>   
   <nav class="navbar">
    @include('sidemenu')
</nav>
   @yield('header')
</header>
<main>
@yield('maincontent')
</main>
<footer>
    @yield('footer')
    @include('footer')
</footer>
</body>
</html>