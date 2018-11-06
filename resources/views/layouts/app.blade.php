<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>XPENSA | Software para la administración de condominios</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    @yield('style')
</head>
<body class="@yield('body-class')">

@yield('content')

<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
@yield('javascript')
</body>
</html>
