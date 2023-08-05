<div class="row mt-4">
    <div class="col-md-12">
        <p>
            <i class="fa fa-user"></i>
            <strong>Pedido(s)</strong>
        </p>

        <table class="table table-condensed">
            <tr>
                <th class="bg-dark text-white">Posição</th>
                <th class="bg-dark text-white">Plano</th>
                <th class="bg-dark text-white">Início</th>
                <th class="bg-dark text-white">Término</th>
                <th class="bg-dark text-white">Valor Concedido</th>
                <th class="bg-dark text-white">1º Vencimento</th>
                <th class="bg-dark text-white">Qtde. de Parcelas</th>
                <th class="bg-dark text-white text-center">Ação</th>
            </tr>

            @forelse ($orders as $order)
                <tr>
                    <td>
                        {{ $order->situation }}
                    </td>
                    <td>
                        {{ optional($order->plan)->description }}
                    </td>
                    <td>
                        {{ optional($order->start_at)->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ optional($order->ends_at)->format('d/m/Y') }}
                    </td>
                    <td>
                        R$ {{ convertDecimalToBRL($order->final_price) }}
                    </td>
                    <td>
                        {{ optional($order->first_due_date)->format('d/m/Y') }}
                    </td>
                    <td>
                        Em {{ $order->installments }}x
                    </td>

                    <td style="width: 210px;">
                        <div class="text-center">
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#editOrder{{$loop->index}}"
                                class="btn btn-outline-success me-1"
                                >Editar
                            </button>
                            
                            {{-- <button
                                data-bs-toggle="modal"
                                data-bs-target="#deleteContact{{$loop->index}}"
                                class="btn btn-outline-danger"
                                >Excluir
                            </button> --}}
                        </div>

                        <x-intec-modal
                            id="editOrder{{ $loop->index }}"
                            aria-labelledby="editOrdertLabel{{ $loop->index }}"
                            route="{{ route('associate.order.update', [$company->id, $order->id]) }}"
                            title="Atualizar Pedido"
                            collection="{{ $order }}"
                            submit-button-class="btn btn-primary"
                            submit-button-text="Salvar"
                            size="modal-xl"
                            http-method="put"
                            >
                            <div class="container-fluid">
                                <div class="container">
                                    @include('layouts.associate.modals.edit_associate_order')
                                </div>
                            </div>
                        </x-intec-modal>

                        {{-- <x-intec-modal
                            id="deleteContact{{ $loop->index }}"
                            aria-labelledby="deleteContactLabel{{ $loop->index }}"
                            route="{{ route('associate.contact.destroy', $order->id) }}"
                            title="Excluir Contato"
                            collection="{{ $order }}"
                            submit-button-class="btn btn-outline-danger"
                            submit-button-text="Deletar"
                            size=""
                            http-method="delete"
                            >
                            <div class="text-center">
                                Tem certeza que deseja excluir o registro do contato: <br>
                                <strong class="text-danger">{{ $order->name }}</strong>?
                            </div>
                        </x-intec-modal> --}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        Nenhum contato encontrado.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>
</div>