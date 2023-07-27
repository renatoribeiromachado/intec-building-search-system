<!-- Modal -->
<div class="modal fade"
    id="removeCompanyFromWork{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="removeCompanyFromWorkLabel"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeCompanyFromWorkLabel">Remover Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    Tem certeza que deseja remover a empresa: <br>
                    <strong class="text-danger">{{ $company->trading_name }}</strong>
                    da obra <strong class="text-danger">{{ $work->name }}</strong>?
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                    >
                    Fechar
                </button>

                <form
                    action="{{ route('work.unbind.company', [$work->id, $company->id]) }}#companies-list-section"
                    method="post"
                    >
                    @csrf
                    @method('delete')

                    <button
                        type="submit"
                        class="btn btn-outline-danger"
                        >
                        Remover
                    </button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End the Modal -->
