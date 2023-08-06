<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<!-- Modal Add Contact -->
<div class="modal fade"
    id="{{ $id }}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="{{ $ariaLabelledby }}"
    aria-hidden="true"
    >
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <form action="{{ $route }}" method="post">
                @csrf
                @method($httpMethod)

                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="{{ $ariaLabelledby }}"
                        >
                        {{ $title }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        >
                    </button>
                </div>

                <div class="modal-body">

                    {{ $slot }}

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
                        class="{{ $submitButtonClass }}"
                        >
                        {{ $submitButtonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End the Modal Add Contact -->
