<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<label for="{{ $labelInputId }}">
    <strong>{{ $labelText }}</strong>
</label>
<input
    id="{{ $labelInputId }}"
    type="{{ $inputType }}"
    name="{{ $inputName }}"
    class="form-control {{ $classOne }} @error($inputName) is-invalid @enderror"
    value="{{ old($inputName, $inputValue) }}"
    placeholder=""
    @if ($inputReadonly) readonly @endif
    >
@error($inputName)
    <div class="invalid-feedback">
        {{ $errors->first($inputName) }}
    </div>
@enderror
