<!doctype html>
<html lang="en">
<head>
    @include('includes.frontend.head')
</head>
<body class="container-fluid container-flex">
    @include('includes.frontend.navbar')
<main>
    @yield('content')
</main>
<footer>
    @include('includes.frontend.footer')
</footer>
<script>
    @include('includes.frontend.scripts')
</script>
</body>
</html>
