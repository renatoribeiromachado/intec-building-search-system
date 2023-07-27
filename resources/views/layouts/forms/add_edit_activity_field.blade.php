
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input
            type="text"
            id="description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
            value="{{ old('description', $activityField->description) }}"
            placeholder="ex: PAISAGISMO"
            >
        @error('description')
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        @enderror
    </div>
</div>