<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
{{-- <div class="form-group @error($selectName) has-error @enderror"> --}}
    <label for="{{ $selectName }}">
        <strong>{{ $selectLabel }}</strong>
        {{-- @if(isset($required) && ($required == true))
        <span class="required-field">*</span>
        @endif --}}
    </label>
    <select
        id="{{ $selectName }}"
        name="{{ $selectName }}"
        class="{{ $selectClass }}"
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
        <span class="text-danger">{!!$errors->first($selectName)!!}</span>
    @enderror
{{-- </div> --}}