<div class="card mb-4">
    @if (!empty($title) || !empty($action))
        <div class="card-header d-flex py-2">
            @if (isset($title))
                <h4 class='card-title fw-semibold'>{{ $title }}</h4>
            @endif
            @if (isset($action))
                <div class="ms-auto d-flex gap-1">{{ $action }}</div>
            @endif
        </div>
    @endif
    <div {{ $attributes->merge(['class' => 'card-body' . ( $expand ? " p-0" : ""), ]) }}>
        {{ $slot }}
    </div>
</div>
