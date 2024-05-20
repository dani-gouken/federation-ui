<div class="card card-sm">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                <span
                    class="@if (!$iconGhost) bg-{{ $theme }} text-{{ $theme }}-fg avatar @else text-{{ $theme }} @endif">
                    @if ($icon)
                        <x-f::icon :name="$icon" />
                    @endif
                </span>
            </div>
            <div class="col">
                <div class="font-weight-medium">
                    {{ $title }}
                    @if ($floatingText)
                        <span class="float-right font-weight-medium text-{{ $floatingTextTheme }}">{{ $floatingText }}</span>
                    @endif
                </div>
                <div class="text-secondary">
                    {{ $description }}
                </div>
            </div>
        </div>
    </div>
</div>
