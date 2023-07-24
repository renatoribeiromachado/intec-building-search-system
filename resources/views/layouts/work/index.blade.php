@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE OBRAS</h1>

        <div>
            <form action="{{ route('work.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Projeto</label>
                        <input
                            type="text" id="name" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', request()->name) }}" placeholder="ex: PCH PALMAS"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('work.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="">
            <a class="btn btn-primary float-end"
                href="{{ route('work.create') }}"
                >
                Novo Cadastro
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código Antigo</th>
                    <th scope="col">Projeto</th>
                    <th scope="col">Revisado em</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fase</th>
                    <th scope="col">Segmento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($works as $work)
                    <tr>
                        <th scope="row">{{ $work->id }}</th>
                        <td>{{ $work->old_code }}</td>
                        <td>{{ $work->name }}</td>
                        <td>{{ optional($work->last_review)->format('d/m/Y') }}</td>
                        <td>R$ {{ $work->price }}</td>
                        <td>{{ optional($work->phase)->description }}</td>
                        <td>{{ optional($work->segment)->description }}</td>
                        <td>
                            <a
                                href="#"
                                class="btn btn-sm btn-outline-primary me-1"
                                data-bs-toggle="modal"
                                data-bs-target="#addContact{{$loop->index}}"
                                >
                                Add Contato
                            </a>
                            <a
                                href="{{ route('work.edit', $work->id) }}"
                                class="btn btn-sm btn-outline-success me-1"
                                >
                                Editar
                            </a>

                            <a
                                href="#"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{$loop->index}}"
                                >
                                Excluir
                            </a>

                            <!-- Modal Add Contact -->
                            <div class="modal fade"
                                id="addContact{{$loop->index}}"
                                data-bs-backdrop="static"
                                data-bs-keyboard="false"
                                tabindex="-1"
                                aria-labelledby="addContactLabel"
                                aria-hidden="true"
                                >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('work.contact.store', $work->id) }}" method="post">
                                            @csrf
                                            @method('post')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addContactLabel">Adicionar Contato</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    Informe os dados do contato e salve, em seguinda é só acessar a
                                                    edição da obra para conferir a lista de contatos vinculados a ela.
                                                </div>

                                                <div class="container">
                                                    <div class="row mt-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="name">Nome</label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                value="{{ old('name') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="position{{$loop->index}}">Cargo</label>
                                                            <select id="position{{$loop->index}}" name="position_id" class="form-control">
                                                                <option selected>-- Selecione --</option>
                                                                @foreach ($positions as $position)
                                                                    @if ($loop->index == 0)
                                                                    <option selected>-- Selecione --</option>
                                                                    @endif
                                            
                                                                    <option
                                                                        value="{{ $position->id }}"
                                                                        @if (old('position_id', $work->position_id) == $position->id) selected @endif
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
                                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                value="{{ old('email') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 mb-2">
                                                            <label for="ddd">DDD</label>
                                                            <input maxlength="3" type="text" id="ddd" name="ddd"
                                                                class="form-control {{ $errors->has('ddd') ? 'is-invalid' : '' }}"
                                                                value="{{ old('ddd') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                        <div class="col-md-8 mb-2">
                                                            <label for="main_phone">Telefone Principal</label>
                                                            <input type="text" id="main_phone" name="main_phone"
                                                                class="form-control {{ $errors->has('main_phone') ? 'is-invalid' : '' }}"
                                                                value="{{ old('main_phone') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 mb-2">
                                                            <label for="ddd_fax">DDD</label>
                                                            <input maxlength="3" type="text" id="ddd_fax" name="ddd_fax"
                                                                class="form-control {{ $errors->has('ddd_fax') ? 'is-invalid' : '' }}"
                                                                value="{{ old('ddd_fax') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                        <div class="col-md-8 mb-2">
                                                            <label for="fax">Fax</label>
                                                            <input type="text" id="fax" name="fax"
                                                                class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}"
                                                                value="{{ old('fax') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 mb-2">
                                                            <label for="ddd_two">DDD 2</label>
                                                            <input maxlength="3" type="text" id="ddd_two" name="ddd_two"
                                                                class="form-control {{ $errors->has('ddd_two') ? 'is-invalid' : '' }}"
                                                                value="{{ old('ddd_two') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                        <div class="col-md-8 mb-2">
                                                            <label for="phone_two">Telefone 2</label>
                                                            <input type="text" id="phone_two" name="phone_two"
                                                                class="form-control {{ $errors->has('phone_two') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_two') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 mb-2">
                                                            <label for="ddd_three">DDD 3</label>
                                                            <input maxlength="3" type="text" id="ddd_three" name="ddd_three"
                                                                class="form-control {{ $errors->has('ddd_three') ? 'is-invalid' : '' }}"
                                                                value="{{ old('ddd_three') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                        <div class="col-md-8 mb-2">
                                                            <label for="phone_three">Telefone 3</label>
                                                            <input type="text" id="phone_three" name="phone_three"
                                                                class="form-control {{ $errors->has('phone_three') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_three') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 mb-2">
                                                            <label for="ddd_four">DDD 4</label>
                                                            <input maxlength="3" type="text" id="ddd_four" name="ddd_four"
                                                                class="form-control {{ $errors->has('ddd_four') ? 'is-invalid' : '' }}"
                                                                value="{{ old('ddd_four') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                        <div class="col-md-8 mb-2">
                                                            <label for="phone_four">Telefone 4</label>
                                                            <input type="text" id="phone_four" name="phone_four"
                                                                class="form-control {{ $errors->has('phone_four') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_four') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="phone_type_one">Tipo de Telefone 1</label>
                                                            <input type="text" id="phone_type_one" name="phone_type_one"
                                                                class="form-control {{ $errors->has('phone_type_one') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_type_one') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="phone_type_two">Tipo de Telefone 1</label>
                                                            <input type="text" id="phone_type_two" name="phone_type_two"
                                                                class="form-control {{ $errors->has('phone_type_two') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_type_two') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="phone_type_three">Tipo de Telefone 1</label>
                                                            <input type="text" id="phone_type_three" name="phone_type_three"
                                                                class="form-control {{ $errors->has('phone_type_three') ? 'is-invalid' : '' }}"
                                                                value="{{ old('phone_type_three') }}"
                                                                placeholder=""
                                                                >
                                                        </div>
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

                            <!-- Modal -->
                            <div class="modal fade"
                                id="staticBackdrop{{$loop->index}}"
                                data-bs-backdrop="static"
                                data-bs-keyboard="false"
                                tabindex="-1"
                                aria-labelledby="staticBackdropLabel"
                                aria-hidden="true"
                                >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Excluir Registro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                Tem certeza que deseja excluir o registro da obra: <br>
                                                <strong class="text-danger">{{ $work->name }}</strong>?
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                                >
                                                Fechar
                                            </button>

                                            <form action="{{ route('work.destroy', $work->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button
                                                    type="submit"
                                                    class="btn btn-outline-danger"
                                                    >
                                                    Deletar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End the Modal -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <p class="text-center mb-0 py-4">
                                Nenhum registro encontrado.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
