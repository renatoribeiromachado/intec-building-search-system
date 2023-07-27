<!-- Modal -->
<div class="modal fade"
    id="searchCompanies"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="searchCompaniesLabel"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('work.bind.companies', $work->id) }}#companies-list-section" method="post">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="addContactLabel">Vincular Empresa(s) Participante(s)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="wrapp-companies-list" class="row"></div>
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
                        Vincular
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End the Modal -->
