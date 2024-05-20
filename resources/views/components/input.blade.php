<div class="@if (!$noMargin) mb-3 @endif">
    @if (!empty($label))
        <label class="form-label @if ($required) required @endif"
            for="{{ $label }}">{!! $label !!}</label>
    @endif
    <div class="input-group @error($name) is-invalid @enderror  input-group-flat" x-data="{ showPassword: false }">
        <input {{ $attributes }} @if ($disabled) disabled @endif type="{{ $type }}"
            @if ($type === 'password') x-bind:type="showPassword ? 'text' : 'password'" @endif
            name="{{ $name }}" aria-describedby="validationServer{{ $name }}"
            placeholder="{{ $placeholder }}" @if ($required) required @endif
            value="{{ old($name) ?? $value }}" class="form-control @error($name) is-invalid @enderror" type="text" />
        @if (!empty($suffix))
            <span class="input-group-text"{{ $suffixAttr }}>{{ $suffix }}</span>
        @elseif($type == 'password')
            <span class="input-group-text">
                <a href="#" x-on:click="showPassword = !showPassword" class="link-secondary"
                    data-bs-toggle="tooltip" aria-label="Voir le mot de passe"
                    data-bs-original-title="Voir le mot de passe">
                    <i x-show="!showPassword" class="ti ti-eye"></i>
                    <i x-show="showPassword" class="ti ti-eye-off"></i>
                </a>
            </span>
        @endif
    </div>
    @error($name)
        <div id="validationServer{{ $name }}" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
