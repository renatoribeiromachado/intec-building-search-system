<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<label class="{{ $labelClass }}" for="{{ $labelInputId }}">
    {{ $labelText }} @if($inputType == 'password')<code>padrão:intec!@#</code>@endif
</label>
<input
    id="{{ $labelInputId }}"
    type="{{ $inputType }}"
    name="{{ $inputName }}"
    class="form-control {{ $classOne }} @error($inputName) is-invalid @enderror"
    @if($inputType == 'password' && \Route::is('associate.user.create'))
    value="{{ old($inputName, 'intec!@#') }}"
    @else
    value="{{ old($inputName, $inputValue) }}"
    @endif
    {{-- placeholder="{{ $inputPlaceholder }}" --}}
    @if ($inputReadonly) readonly @endif
    {{ $attributes }}
    >
@error($inputName)
    <div class="invalid-feedback">
        {{ $errors->first($inputName) }}
    </div>
@enderror
