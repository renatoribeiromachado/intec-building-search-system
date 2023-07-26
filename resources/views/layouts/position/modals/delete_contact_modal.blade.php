<!-- Modal -->
<div class="modal fade"
    id="deleteContact{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteContactLabel"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteContactLabel">Excluir Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    Tem certeza que deseja excluir o registro do contato: <br>
                    <strong class="text-danger">{{ $contact->name }}</strong>?
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                    >
                    Fechar
                </button>

                <form action="{{ route('company.contact.destroy', $contact->id) }}#contacts-section" method="post">
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