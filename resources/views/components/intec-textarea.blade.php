
<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<label class="{{ $labelClass }}" for="{{ $labelTextareaId }}">
    {{ $labelText }}
</label>
<textarea
    id="{{ $labelTextareaId }}"
    type="{{ $textareaType }}"
    name="{{ $textareaName }}"
    class="form-control {{ $classOne }} @error($textareaName) is-invalid @enderror"
    value="{{ old($textareaName, $textareaValue) }}"
    placeholder=""
    rows="{{ $rows }}"
    @if ($textareaReadonly) readonly @endif
    >{{ old($textareaName, $textareaValue) }}</textarea>
@error($textareaName)
    <div class="invalid-feedback">
        {{ $errors->first($textareaName) }}
    </div>
@enderror
