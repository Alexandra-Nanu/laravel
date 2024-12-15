<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=" …">
    <title>Exemplu creare Blade</title>
    @include('partials.styles')
</head>
<body>
@include('partials.header')
<main class="container mt-5">
    @yield('content')
</main>
@include('partials.footer')
</body>
</html>
