<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>

<body>
<header>
    <img src="{{asset('images/nota.jpg')}}" alt="">
   @yield('header') 
 <!--@include('sidemenu')-->
</header>
<main>
@yield('maincontent')
</main>
<footer>
    @yield('footer')
</footer>
</body>
</html>