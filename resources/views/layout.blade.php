<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('style')

    <link rel="stylesheet" href="{{ asset('/build/assets/layout-style-qopEgKEL.css') }}">
    <script type="module" defer src="{{ asset('/build/assets/app-BrdkcW99.js') }}"></script>

</head>

<body>
    @yield('content')
    @yield('script')
</body>

</html>
