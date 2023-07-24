<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input
            type="text"
            id="description"
            name="description"
            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
            value="{{ old('description', $segment->description) }}"
            placeholder="ex: RESIDENCIAL"
            >
    </div>
</div>
