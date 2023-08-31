<!-- Modal -->
<div class="modal fade"
    id="archiveContact{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="archiveContactLabel"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveContactLabel">Arquivar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    Tem certeza que deseja arquivar o registro do contato: <br>
                    <strong class="text-black">{{ $contact->name }}</strong>?
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"
                    >
                    Fechar
                </button>

                <form action="{{ route('company.contact.archive', $contact->id) }}#contacts-section" method="post">
                    @csrf
                    @method('delete')

                    <button
                        type="submit"
                        class="btn btn-outline-warning"
                        >
                        Arquivar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End the Modal -->