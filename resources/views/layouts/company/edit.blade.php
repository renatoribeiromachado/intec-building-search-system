@extends('layouts.app_customer')

@section('content')
<div class="container">
    <div class="bg-light p-5 rounded mb-5">
        <h3>EDIÇÃO DE EMPRESA</h3>

        <form action="{{ route('company.update', $company->id) }}" method="POST" role="form">
            @csrf
            @method('post')
            <input type="hidden" name="company_id" value="{{ $company->id }}">

            @include('layouts.forms.add_edit_company')

            <div class="form-row my-3 px-4">
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        >
                        Salvar
                    </button>

                    <a
                        href="#"
                        class="btn btn-outline-success me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#addContact"
                        >
                        Add Contato
                    </a>
                </div>
            </div>
        </form>

        @include('layouts.position.modals.add_contact_modal')

        <hr class="my-4">

        <div class="row px-3">
            <div class="col">
                <h2 class="mb-4">Contatos</h2>
                <div class="row">
                    <a class="invisible" name="contacts-section"></a>
                    @foreach ($company->contacts()->where('contacts.archived', false)->get() as $contact)
                        <div class="col-3 mb-3">
                            <div class="card rounded-3" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $contact->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        {{ optional($contact->position)->description }}
                                    </h6>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Atualizado {{ optional($contact->updated_at)->diffForHumans() }}
                                        </small>
                                    </p>
                                    
                                    @if ($contact->email)
                                    <a href="mailto:{{ $contact->email }}"
                                        class="card-link d-block mb-2 ms-0"
                                        >
                                        {{ $contact->email }}
                                    </a>
                                    @endif
                                    
                                    @if ($contact->secondary_email)
                                    <a href="mailto:{{ $contact->secondary_email }}"
                                        class="card-link d-block mb-2 ms-0"
                                        >
                                        {{ $contact->secondary_email }}
                                    </a>
                                    @endif
                                    
                                    @if ($contact->tertiary_email)
                                    <a href="mailto:{{ $contact->tertiary_email }}"
                                        class="card-link d-block mb-2 ms-0"
                                        >
                                        {{ $contact->tertiary_email }}
                                    </a>
                                    @endif

                                    @if ($contact->ddd && $contact->main_phone)
                                    <a href="tel:+55{{ $contact->ddd }}{{ $contact->main_phone }}"
                                        class="card-link d-block ms-0 mb-2 ms-0"
                                        >({{ $contact->ddd }}) {{ $contact->main_phone }}
                                    </a>
                                    @endif

                                    @if ($contact->ddd_two && $contact->phone_two)
                                    <a href="tel:+55{{ $contact->ddd_two }}{{ $contact->phone_two }}"
                                        class="card-link d-block ms-0 mb-2"
                                        >({{ $contact->ddd_two }}) {{ $contact->phone_two }}
                                    </a>
                                    @endif

                                    @if ($contact->ddd_three && $contact->phone_three)
                                    <a href="tel:+55{{ $contact->ddd_three }}{{ $contact->phone_three }}"
                                        class="card-link d-block ms-0 mb-2"
                                        >({{ $contact->ddd_three }}) {{ $contact->phone_three }}
                                    </a>
                                    @endif

                                    @if ($contact->ddd_four && $contact->phone_four)
                                    <a href="tel:+55{{ $contact->ddd_four }}{{ $contact->ddd_four }}"
                                        class="card-link d-block ms-0 mb-2"
                                        >({{ $contact->ddd_four }}) {{ $contact->phone_four }}
                                    </a>
                                    @endif

                                    <div class="mt-3">
                                        <button
                                            data-bs-toggle="modal"
                                            data-bs-target="#editContact{{$loop->index}}"
                                            class="btn btn-primary d-inline-block"
                                            >Editar
                                        </button>
                                        
                                        <button
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteContact{{$loop->index}}"
                                            class="btn btn-outline-danger d-inline-block"
                                            >Excluir
                                        </button>
                                        
                                        <button
                                            data-bs-toggle="modal"
                                            data-bs-target="#archiveContact{{$loop->index}}"
                                            class="btn btn-outline-dark d-inline-block"
                                            >
                                            Arquivar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('layouts.position.modals.edit_contact_modal')

                        @include('layouts.position.modals.delete_contact_modal')

                        @include('layouts.position.modals.archive_contact_modal')
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
