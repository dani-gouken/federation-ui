<div class="mb-3">
    @if (!empty($label))
        <label class="form-label @if ($required) required @endif"
            for="{{ $label }}">{{ $label }}</label>
    @endif
    <div class="input-group">
        <textarea {{ $attributes }} @if ($disabled) disabled @endif
            name="{{ $name }}" aria-describedby="validationServer{{ $name }}" placeholder="{{ $placeholder }}"
            @if ($required) required @endif
            class="form-control @error($name) is-invalid @enderror" type="text">{{ old($name) ?? $value }}</textarea>
        @error($name)
            <div id="validationServer{{ $name }}" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
