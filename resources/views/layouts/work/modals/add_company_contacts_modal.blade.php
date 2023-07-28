<!-- Modal -->
<div class="modal fade"
    id="addCompanyContacts{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="addCompanyContactsLabel{{$loop->index}}"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('work.bind.company.contacts', [$work->id, $company->id]) }}#companies-list-section" method="post">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyContactsLabel{{$loop->index}}">Incluir Contatos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3>{{ $company->trading_name }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($company->contacts as $contact)
                                <div class="col-md-6 mb-1 mt-1">
                                    <input
                                        type="checkbox"
                                        name="contacts_list[]"
                                        value="{{ $contact->id }}"
                                        class="form-check-input me-1"
                                        id="contacts-list-{{ $company->id.$loop->index }}"
                                        @if(
                                            $work->companyContacts()
                                                ->where('contact_work.company_id', $company->id)
                                                ->where('contact_id', $contact->id)
                                                ->exists()
                                            )
                                            checked
                                        @endif
                                        />
                                    <label
                                        class="form-check-label"
                                        for="contacts-list-{{ $company->id.$loop->index }}">
                                        {{ $contact->name }} ({{ optional($contact->position)->description }})
                                    </label>
                                </div>
                            @endforeach
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
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End the Modal -->
