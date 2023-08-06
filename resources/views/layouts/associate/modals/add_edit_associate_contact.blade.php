<!-- Modal Add Contact -->
<div class="row mt-2">
    <div class="col-md-7 mb-2">
        <x-intec-input
            label-input-id="name"
            label-text="Nome"
            input-type="text"
            input-name="name"
            class-one=""
            input-value="{{ $contact->name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-5 mb-2">
        <x-intec-select
            select-name="position_id"
            select-label="Cargo"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$positions"
            value="{{ optional($contact->position)->id }}"
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
            input-value="{{ $contact->email }}"
            :input-readonly="false"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="secondary_email"
            label-text="E-mail 2"
            input-type="email"
            input-name="secondary_email"
            class-one=""
            input-value="{{ $contact->secondary_email }}"
            :input-readonly="false"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="tertiary_email"
            label-text="E-mail 3"
            input-type="email"
            input-name="tertiary_email"
            class-one=""
            input-value="{{ $contact->tertiary_email }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2 mb-2">
        <x-intec-input
            label-input-id="ddd"
            label-text="DDD 1"
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
            label-text="Telefone 1"
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
    <div class="col-md-2 mb-2">
        <x-intec-input
            label-input-id="ddd_three"
            label-text="DDD 3"
            input-type="text"
            input-name="ddd_three"
            class-one=""
            input-value="{{ $contact->ddd_three }}"
            :input-readonly="false"
            maxlength="3"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="phone_three"
            label-text="Telefone 3"
            input-type="text"
            input-name="phone_three"
            class-one=""
            input-value="{{ $contact->phone_three }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2 mb-2">
        <x-intec-input
            label-input-id="ddd_four"
            label-text="DDD 4"
            input-type="text"
            input-name="ddd_four"
            class-one=""
            input-value="{{ $contact->ddd_four }}"
            :input-readonly="false"
            maxlength="3"
        />
    </div>
    <div class="col-md-4 mb-2">
        <x-intec-input
            label-input-id="phone_four"
            label-text="Telefone 4"
            input-type="text"
            input-name="phone_four"
            class-one=""
            input-value="{{ $contact->phone_four }}"
            :input-readonly="false"
        />
    </div>
</div>
                            