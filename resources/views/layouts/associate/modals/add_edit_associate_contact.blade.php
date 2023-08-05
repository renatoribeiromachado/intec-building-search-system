<!-- Modal Add Contact -->
<div class="row mt-2">
    <div class="col-md-7 mb-2">
        <x-intec-input
            label-input-id="name"
            label-text="Nome 2"
            input-type="text"
            input-name="name"
            class-one=""
            input-value="{{ $contact->name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-5 mb-2">
        <label for="position">Cargo</label>
        <select id="position" name="position_id" class="form-control">
            <option selected>-- Selecione --</option>
            @forelse ($positions as $position)
                {{-- @if ($loop->index == 0)
                <option selected>-- Selecione --</option>
                @endif --}}

                <option
                    value="{{ $position->id }}"
                    @if (old('position_id', optional($contact->position)->id) == $position->id)
                    selected
                    @endif
                    >
                    {{ $position->description }}
                </option>
                @empty
                <option selected>-- Selecione --</option>
            @endforelse
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4 mb-2">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $contact->email) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="secondary_email">E-mail 2</label>
        <input type="email" id="secondary_email" name="secondary_email"
            class="form-control @error('secondary_email') is-invalid @enderror"
            value="{{ old('secondary_email', $contact->secondary_email) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="tertiary_email">E-mail 3</label>
        <input type="email" id="tertiary_email" name="tertiary_email"
            class="form-control @error('tertiary_email') is-invalid @enderror"
            value="{{ old('tertiary_email', $contact->tertiary_email) }}"
            placeholder=""
            >
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2 mb-2">
        <label for="ddd">DDD 1</label>
        <input maxlength="3" type="text" id="ddd" name="ddd"
            class="form-control @error('ddd') is-invalid @enderror"
            value="{{ old('ddd', $contact->ddd) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="main_phone">Telefone 1</label>
        <input type="text" id="main_phone" name="main_phone"
            class="form-control @error('main_phone') is-invalid @enderror"
            value="{{ old('main_phone', $contact->main_phone) }}"
            placeholder=""
            >
    </div>

    <div class="col-md-2 mb-2">
        <label for="ddd_two">DDD 2</label>
        <input maxlength="3" type="text" id="ddd_two" name="ddd_two"
            class="form-control @error('ddd_two') is-invalid @enderror"
            value="{{ old('ddd_two', $contact->ddd_two) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="phone_two">Telefone 2</label>
        <input type="text" id="phone_two" name="phone_two"
            class="form-control @error('phone_two') is-invalid @enderror"
            value="{{ old('phone_two', $contact->phone_two) }}"
            placeholder=""
            >
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2 mb-2">
        <label for="ddd_three">DDD 3</label>
        <input maxlength="3" type="text" id="ddd_three" name="ddd_three"
            class="form-control @error('ddd_three') is-invalid @enderror"
            value="{{ old('ddd_three', $contact->ddd_three) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="phone_three">Telefone 3</label>
        <input type="text" id="phone_three" name="phone_three"
            class="form-control @error('phone_three') is-invalid @enderror"
            value="{{ old('phone_three', $contact->phone_three) }}"
            placeholder=""
            >
    </div>

    <div class="col-md-2 mb-2">
        <label for="ddd_four">DDD 4</label>
        <input maxlength="3" type="text" id="ddd_four" name="ddd_four"
            class="form-control @error('ddd_four') is-invalid @enderror"
            value="{{ old('ddd_four', $contact->ddd_four) }}"
            placeholder=""
            >
    </div>
    <div class="col-md-4 mb-2">
        <label for="phone_four">Telefone 4</label>
        <input type="text" id="phone_four" name="phone_four"
            class="form-control @error('phone_four') is-invalid @enderror"
            value="{{ old('phone_four', $contact->phone_four) }}"
            placeholder=""
            >
    </div>
</div>
                            