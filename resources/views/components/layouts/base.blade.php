<html lang="en">
@if (isset($head) && !is_null($head))
    {{ $head }}
@elseif(!empty(federation()->getHeadTemplate()))
    @includeWhen(!empty(federation()->getHeadTemplate()), federation()->getHeadTemplate())
@else

    <head>
        @includeWhen(!empty(federation()->getHeadStart()), federation()->getHeadStart())
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ federation()->buildPageTitle(request()) }}</title>
        @federationStyle
        @includeWhen(!empty(federation()->getHeadEnd()), federation()->getHeadEnd())
    </head>
@endif

<body class="{{ federation('page.body.class') }}">
    @if (isset($start) && !is_null($start))
        {{ $start }}
    @elseif (!empty(federation()->getBodyStart()))
        @includeWhen(!empty(federation()->getBodyStart()), federation()->getBodyStart())
    @endif
    <div class="page" id="app">
        {{ $slot }}
    </div>
    @if (isset($end) && !is_null($end))
        {{ $end }}
    @elseif (!empty(federation()->getBodyEnd()))
        @includeWhen(!empty(federation()->getBodyEnd()), federation()->getBodyEnd())
    @else
        @federationScript
    @endif
</body>

</html>
