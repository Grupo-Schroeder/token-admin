@props([
    'name',
    'label',
    'required' => false,
    'hint' => null,
])

<div {{ $attributes->class(['form-field']) }}>
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="required" aria-label="obligatorio">*</span>
        @endif
    </label>

    {{ $slot }}

    @if ($hint)
        <p class="field-hint">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="field-error" id="{{ $name }}-error">{{ $message }}</p>
    @enderror
</div>
