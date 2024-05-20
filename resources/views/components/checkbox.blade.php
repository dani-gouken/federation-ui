    <label class="form-check">
        <input {{ $attributes }} class="form-check-input @error($name) is-invalid @enderror" type="checkbox" @checked($list ? $checked : old($name, $checked))
            name="{{ $list ? $name . '[]' : $name }}" value="{{ $value }}">
        <span class="form-check-label">
            {{ $title }}
        </span>
        @if (!empty($description))
            <span class="form-check-description">
                {{ $description }}
            </span>
        @endif
    </label>
