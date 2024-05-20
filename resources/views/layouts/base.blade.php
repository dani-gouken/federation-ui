<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') . (isset($page_title) ? "- {$page_title}" : '') }}</title>
    @federationStyle
    @yield('header')
</head>

<body>
    <div class="page" id="app">
        @yield('page')
    </div>
    @federationScript
    @yield('footer')
</body>

</html>
