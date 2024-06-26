
@include('layouts.alerts.all-errors')

<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}" placeholder="ex: Flávio Oliveira">
    </div>
</div>

<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}" placeholder="ex: flavio.oliveira@outlook.com">
    </div>
</div>

<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="password">Senha <small>(mínimo de 8 dígitos)</small></label>
        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}" autocomplete="current-password" @if(! \Route::is('user.edit')) required @endif>
    </div>
</div>

<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="password_confirmation">Confirme a Senha</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password_confirmation') }}" @if(! \Route::is('user.edit')) required @endif>
    </div>
</div>

<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="role">Perfil</label>
        <select id="role" name="role_id" class="form-control">

            @foreach ($roles as $role)
                @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                @endif

                <option
                    value="{{ $role->id }}"
                    @if (old('role_id', $user->role_id) == $role->id) selected @endif
                    >
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
