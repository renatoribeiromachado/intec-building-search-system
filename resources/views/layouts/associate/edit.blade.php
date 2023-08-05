@extends('layouts.app_customer')

@section('content')
    <div class="container pb-4 bg-light border">
        <div class="row mt-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> Adicionar contatos / Pedido / Assinatura / Acesso</h4>
            </div>
        </div>

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <form action="{{ route('associate.update', $associate->id) }}" method="post" role="form">
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_associate')

            <div class="row mt-4">
                <div class="col-md-12">
                    <button
                        type="button"
                        class="btn btn-outline-success me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#addContact"
                        >
                        Add contatos
                    </button>
                    <button
                        type="submit"
                        class="btn btn-outline-success me-1 text-dark"
                        >
                        Atualizar alteração de cadastro
                    </button>
                </div>
            </div>
        </form>

        <x-intec-modal
            id="addContact"
            aria-labelledby="addContactLabel"
            route="{{ route('associate.contact.store', $company->id) }}"
            title="Adicionar Contato"
            collection="{{ $contact }}"
            submit-button-class="btn btn-primary"
            submit-button-text="Salvar"
            size="modal-xl"
            http-method="post"
            >
            <div class="container-fluid">
                <div class="container">
                    @include('layouts.associate.modals.add_edit_associate_contact')
                </div>
            </div>
        </x-intec-modal>

        <div class="row mt-4">
            <div class="col-md-12">
                <p>
                    <i class="fa fa-user"></i>
                    <strong> Contato(s)</strong>
                </p>

                <table class="table table-condensed">
                    <tr>
                        <th class="bg-dark text-white">Nome</th>
                        <th class="bg-dark text-white">E-mail</th>
                        <th class="bg-dark text-white">Cargo</th>
                        <th class="bg-dark text-white">Telefone 1</th>
                        <th class="bg-dark text-white">Telefone 2</th>
                        <th class="bg-dark text-white">Telefone 3</th>
                        <th class="bg-dark text-white">Telefone 4</th>
                        <th class="bg-dark text-white text-center">Ação</th>
                    </tr>

                    @foreach ($company->contacts()->get() as $contact)
                        <tr>
                            <td>
                                {{ $contact->name }}
                            </td>
                            <td>
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
                                </a> <br>
                                @endif
                            </td>
                            <td>
                                {{ optional($contact->position)->description }}
                            </td>
                            <td>
                                @if ($contact->ddd && $contact->main_phone)
                                <a href="tel:+55{{ $contact->ddd }}{{ $contact->main_phone }}"
                                    class="card-link d-block ms-0 mb-2 ms-0"
                                    >({{ $contact->ddd }}) {{ $contact->main_phone }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if ($contact->ddd_two && $contact->phone_two)
                                <a href="tel:+55{{ $contact->ddd_two }}{{ $contact->phone_two }}"
                                    class="card-link d-block ms-0 mb-2"
                                    >({{ $contact->ddd_two }}) {{ $contact->phone_two }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if ($contact->ddd_three && $contact->phone_three)
                                <a href="tel:+55{{ $contact->ddd_three }}{{ $contact->phone_three }}"
                                    class="card-link d-block ms-0 mb-2"
                                    >({{ $contact->ddd_three }}) {{ $contact->phone_three }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if ($contact->ddd_four && $contact->phone_four)
                                <a href="tel:+55{{ $contact->ddd_four }}{{ $contact->ddd_four }}"
                                    class="card-link d-block ms-0 mb-2"
                                    >({{ $contact->ddd_four }}) {{ $contact->phone_four }}
                                </a>
                                @endif
                            </td>

                            <td style="width: 210px;">
                                <div class="text-center">
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#editContact{{$loop->index}}"
                                        class="btn btn-outline-success me-1"
                                        >Editar
                                    </button>
                                    
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteContact{{$loop->index}}"
                                        class="btn btn-outline-danger"
                                        >Excluir
                                    </button>
                                </div>

                                <x-intec-modal
                                    id="editContact{{ $loop->index }}"
                                    aria-labelledby="editContactLabel{{ $loop->index }}"
                                    route="{{ route('associate.contact.update', $contact->id) }}"
                                    title="Atualizar Contato"
                                    collection="{{ $contact }}"
                                    submit-button-class="btn btn-primary"
                                    submit-button-text="Salvar"
                                    size="modal-xl"
                                    http-method="put"
                                    >
                                    <div class="container-fluid">
                                        <div class="container">
                                            @include('layouts.associate.modals.add_edit_associate_contact')
                                        </div>
                                    </div>
                                </x-intec-modal>

                                <x-intec-modal
                                    id="deleteContact{{ $loop->index }}"
                                    aria-labelledby="deleteContactLabel{{ $loop->index }}"
                                    route="{{ route('associate.contact.destroy', [$company->id, $contact->id]) }}"
                                    title="Excluir Contato"
                                    collection="{{ $contact }}"
                                    submit-button-class="btn btn-outline-danger"
                                    submit-button-text="Deletar"
                                    size=""
                                    http-method="delete"
                                    >
                                    <div class="text-center">
                                        Tem certeza que deseja excluir o registro do contato: <br>
                                        <strong class="text-danger">{{ $contact->name }}</strong>?
                                    </div>
                                </x-intec-modal>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
