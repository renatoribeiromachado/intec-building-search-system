<x-intec-modal
    id="addAccess"
    aria-labelledby="addAccessLabel"
    route="{{ route('associate.user.store', $company->id) }}"
    title="Adicionar Acesso para Associado"
    collection="{{ $associates }}"
    submit-button-class="btn btn-primary"
    submit-button-text="Salvar"
    size="modal-xl"
    http-method="post"
    >
    <div class="container-fluid">
        <div class="container">
            @include('layouts.associate.modals.add_edit_associate_user')
        </div>
    </div>
</x-intec-modal>

<x-intec-modal
    id="addSignature"
    aria-labelledby="addSignatureLabel"
    route="{{ route('associate.subscription.store', $company->associate->id) }}"
    title="Adicionar Acesso para Associado"
    collection="{{ $associates }}"
    submit-button-class="btn btn-primary"
    submit-button-text="Salvar"
    size="modal-xl"
    http-method="post"
    >
    <div class="container-fluid">
        <div class="container">
            @include('layouts.associate.modals.add_edit_associate_subscription')
        </div>
    </div>
</x-intec-modal>

<div class="row mt-4">
    <div class="col-md-12">
        <p>
            <i class="fa fa-user"></i>
            <strong>Dados de acesso</strong>
        </p>

        <table class="table table-condensed">
            <tr>
                <th class="bg-dark text-white">Nome</th>
                <th class="bg-dark text-white">E-mail</th>
                <th class="bg-dark text-white">Telefone(s)</th>
                <th class="bg-dark text-white">Cargo</th>
                <th class="bg-dark text-white">Status</th>
                <th class="bg-dark text-white text-center">Ação</th>
            </tr>

            @forelse ($associates as $contact)
                <tr>
                    <td>
                        {{ $contact->name }}
                    </td>
                    <td>
                        {{ $contact->user->email }}
                    </td>
                    <td>
                        @if ($contact->ddd && $contact->main_phone)
                        ({{ $contact->ddd }}) {{ $contact->main_phone }} /
                        @endif
                        @if ($contact->ddd_two && $contact->phone_two)
                        ({{ $contact->ddd_two }}) {{ $contact->phone_two }}
                        @endif
                    </td>
                    <td>
                        {{ optional($contact->position)->description }}
                    </td>
                    <td>
                        @if($contact->user->is_active)
                            Ativo
                        @else
                            Inativo
                        @endif
                    </td>
                    <td style="width: 210px;">
                        <div class="text-center">
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#editAssociate{{$loop->index}}"
                                class="btn btn-outline-success me-1"
                                >Editar
                            </button>
                            
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#deleteAssociate{{$loop->index}}"
                                class="btn btn-outline-danger"
                                >Excluir
                            </button>
                        </div>

                        <x-intec-modal
                            id="editAssociate{{ $loop->index }}"
                            aria-labelledby="editAssociatetLabel{{ $loop->index }}"
                            route="{{ route('associate.user.update', [$company->id, $contact->id]) }}"
                            title="Atualizar Acesso"
                            collection="{{ $contact }}"
                            submit-button-class="btn btn-primary"
                            submit-button-text="Salvar"
                            size="modal-xl"
                            http-method="put"
                            >
                            <div class="container-fluid">
                                <div class="container">
                                    @include('layouts.associate.modals.add_edit_associate_user')
                                </div>
                            </div>
                        </x-intec-modal>

                        <x-intec-modal
                            id="deleteAssociate{{ $loop->index }}"
                            aria-labelledby="deleteAssociateLabel{{ $loop->index }}"
                            route="{{ route('associate.user.destroy', [$company->id, $contact->id]) }}"
                            title="Excluir Acesso"
                            collection="{{ $contact }}"
                            submit-button-class="btn btn-outline-danger"
                            submit-button-text="Deletar"
                            size=""
                            http-method="delete"
                            >
                            <div class="text-center">
                                Tem certeza que deseja excluir o registro do acesso de: <br>
                                <strong class="text-danger">{{ $contact->user->name }}</strong>?
                            </div>
                        </x-intec-modal>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        Nenhum acesso a associado encontrado.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>
</div>
