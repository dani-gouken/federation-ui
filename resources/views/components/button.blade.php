<{{ $tag }} {{ $attributes }} @if ($href && $tag === 'a') href="{{ $href }}" @endif
    @if ($tag === 'button') type="{{ $type }}" @endif
    @if ($onclick) onclick="{{ $onclick }}" @endif
    class="btn @if ($ghost) btn-ghost-{{ $variant }} @else  btn-{{ $variant }} @endif @if ($small) btn-sm @endif"
    @if ($disabled) disabled @endif>
    @if ($icon)
        <i class="ti mb-0 ti-{{ $icon }} fw-normal h2"></i>&nbsp;
    @endif
    {{ $slot }}
    </{{ $tag }}>
