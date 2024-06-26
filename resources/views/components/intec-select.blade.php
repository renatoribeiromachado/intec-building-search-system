<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<div class="form-group">
    <label for="{{ $selectName }}">
        @if(\Route::is('work.search.step_one.index')
            || \Route::is('company.search.step_one.index'))
        {{ $selectLabel }}
        @endif
        @if(! \Route::is('work.search.step_one.index')
            && ! \Route::is('company.search.step_one.index'))
        <strong>{{ $selectLabel }}</strong>
        @endif
        {{-- @if(isset($required) && ($required == true))
        <span class="required-field">*</span>
        @endif --}}
    </label>
    <select
        id="{{ $selectName }}"
        name="{{ $selectName }}"
        class="{{ $selectClass }} @error($selectName) is-invalid @enderror"
        >
        <option value="">{{ $placeholder }}</option>

        @foreach($collection as $key => $select_value)
            <option
                value="{{ $key }}"
                @if(old($selectName, (isset($value)) ? $value : null) == $key)
                selected
                @endif
            >{{ $select_value }}</option>
        @endforeach
    </select>
    
    @error($selectName)
        <div class="invalid-feedback">
            {{ $errors->first($selectName) }}
        </div>
    @enderror
</div>