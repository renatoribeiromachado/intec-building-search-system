<div class="row mt-2">
    <div class="col-md-6 mb-2">
        <x-intec-input
            label-input-id="name"
            label-text="Nome"
            input-type="text"
            input-name="name"
            class-one=""
            input-value="{{ optional($contact->user)->name }}"
            :input-readonly="false"
            required
        />
    </div>
    <div class="col-md-6 mb-2">
        <x-intec-select
            select-name="position_id"
            select-label="Cargo"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$positions"
            value="{{ $contact->position_id }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2 mb-2">
        <x-intec-input
            label-input-id="ddd"
            label-text="DDD"
            input-type="text"
            input-name="ddd"
            class-one=""
            input-value="{{ $contact->ddd }}"
            :input-readonly="false"
            maxlength="3"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="main_phone"
            label-text="Telefone"
            input-type="text"
            input-name="main_phone"
            class-one=""
            input-value="{{ $contact->main_phone }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2 mb-2">
        <x-intec-input
            label-input-id="ddd_two"
            label-text="DDD 2"
            input-type="text"
            input-name="ddd_two"
            class-one=""
            input-value="{{ $contact->ddd_two }}"
            :input-readonly="false"
            maxlength="3"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="phone_two"
            label-text="Telefone 2"
            input-type="text"
            input-name="phone_two"
            class-one=""
            input-value="{{ $contact->phone_two }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="email"
            label-text="E-mail"
            input-type="email"
            input-name="email"
            class-one=""
            input-value="{{ optional($contact->user)->email }}"
            :input-readonly="false"
        />
    </div>
    
    <div class="col-md-3 mb-2">
        <x-intec-input
            label-input-id="password"
            label-text="Senha"
            input-type="password"
            input-name="password"
            class-one=""
            input-value=""
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3 mb-2">
        <x-intec-select
            select-name="role_id"
            select-label="Perfil"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$roles"
            value="{{ optional($contact->user)->role_id }}"
        />
    </div>

    <div class="col-md-2 mb-2">
        <x-intec-select
            select-name="user_is_active"
            select-label="Status:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$isActive"
            value="{{ optional($contact->user)->is_active }}"
        />
    </div>
</div>
