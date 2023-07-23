<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Nome</label>
        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $role->name) }}" placeholder="ex: Consultor">
    </div>
</div>