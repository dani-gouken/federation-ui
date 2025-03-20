<div class="row @if (!$noMargin) mb-3 @endif">
    @if (!empty($label))
        <label for="{{ $name }}"
            class="form-label @if ($required) required @endif">{{ $label }}</label>
    @endif
    <div class="@error($name) is-invalid @enderror">
        <multi-select
        selected="{{ json_encode($selected) }}"
         @if ($multiple) :multiple="true" @endif {{ $attributes }}
            @if ($disabled) disabled @endif @if ($required) required @endif
            name="{{ $multiple ? $name . '[]' : $name }}" class="@error($name) is-invalid @enderror"
            id="{{ $name }}" options="{{ json_encode($options) }}" placeholder="{{ $placeholder }}">
            {{-- @if ($placeholder)
                <option value='' @if (!$selected) selected @endif disabled>{{ $placeholder }}</option>
                <option value='' @if (!$selected) selected @endif hidden>{{ $placeholder }}</option>
            @endif
            @if (!empty($empty))
                <option value=''>{{ $empty }}</option>
            @endif
            @foreach ($options as $key => $value)
            @php
                $valueToCheck = array_is_list($options) ? $value : $key;
            @endphp
                <option @if ($valueToCheck == $selected || (is_array($selected) && in_array($valueToCheck, $selected))) selected @endif value="{{ $key }}">{{ $value }}
                </option>
            @endforeach --}}
        </multi-select>
    </div>
    @error($name)
        <div id="validationServer{{ $name }}" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
