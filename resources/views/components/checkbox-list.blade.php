<div class="">
    <div {{ $attributes->merge(['class' => $errors->get($name) ? 'is-invalid' : '']) }}>
        @foreach ($items as $item)
            <x-f::checkbox :title="$title" :description="$description" :name="$name" list :value="$value" :checked="in_array(is_object($item) ? $item->{$value} : $value, old($name, $checked))"
                :model="$item" />
        @endforeach
    </div>
    @error($name)
        <div id="validationServer{{ $name }}" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
