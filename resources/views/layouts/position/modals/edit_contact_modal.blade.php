<!-- Modal Add Contact -->
<div class="modal fade"
    id="editContact{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editContactLabel{{$loop->index}}"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('company.contact.update', [$contact->id]) }}#contacts-section" method="post">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="addContactLabel{{$loop->index}}">Atualizar Contato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="container">
                         
                                <div class="row mt-2">
                                    <div class="col-md-7 mb-2">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $contact->name) }}"
                                            placeholder=""
                                            >
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <label for="position">Cargo</label>
                                        <select id="position" name="position_id" class="form-control">
                                            <option selected>-- Selecione --</option>
                                            @foreach ($positions as $position)
                                                @if ($loop->index == 0)
                                                <option selected>-- Selecione --</option>
                                                @endif
                        
                                                <option
                                                    value="{{ $position->id }}"
                                                    @if (old('position_id', optional($contact->position)->id) == $position->id)
                                                    selected
                                                    @endif
                                                    >
                                                    {{ $position->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12 mb-2">
                                        <label for="email">E-mail</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $contact->email) }}"
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
                              
                                    <!-- Não esta em uso
                                    <div class="row mt-2">
                                        <div class="col-md-4 mb-2">
                                            <label for="ddd_fax">DDD</label>
                                            <input maxlength="3" type="text" id="ddd_fax" name="ddd_fax"
                                                class="form-control @error('ddd_fax') is-invalid @enderror"
                                                value="{{ old('ddd_fax', $contact->ddd_fax) }}"
                                                placeholder=""
                                                >
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <label for="fax">Fax</label>
                                            <input type="text" id="fax" name="fax"
                                                class="form-control @error('fax') is-invalid @enderror"
                                                value="{{ old('fax', $contact->fax) }}"
                                                placeholder=""
                                                >
                                        </div>
                                    </div>
                                    -->
                                
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
                            <!-- Não esta em uso
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <label for="phone_type_one">Tipo de Telefone 1</label>
                                    <input type="text" id="phone_type_one" name="phone_type_one"
                                        class="form-control @error('phone_type_one') is-invalid @enderror"
                                        value="{{ old('phone_type_one', $contact->phone_type_one) }}"
                                        placeholder=""
                                        >
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <label for="phone_type_two">Tipo de Telefone 2</label>
                                    <input type="text" id="phone_type_two" name="phone_type_two"
                                        class="form-control @error('phone_type_two') is-invalid @enderror"
                                        value="{{ old('phone_type_two', $contact->phone_type_two) }}"
                                        placeholder=""
                                        >
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <label for="phone_type_three">Tipo de Telefone 3</label>
                                    <input type="text" id="phone_type_three" name="phone_type_three"
                                        class="form-control @error('phone_type_three') is-invalid @enderror"
                                        value="{{ old('phone_type_three', $contact->phone_type_three) }}"
                                        placeholder=""
                                        >
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal"
                        >
                        Fechar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        >
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End the Modal Add Contact -->