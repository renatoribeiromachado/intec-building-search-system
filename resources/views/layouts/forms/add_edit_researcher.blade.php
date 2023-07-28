<div class="form-row">
    <div class="form-group col-md-12">
        <label for="name">Nome</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $researcher->name) }}"
            placeholder="ex: FH"
            >
    </div>
</div>