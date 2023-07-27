<!-- Modal -->
<div class="modal fade"
    id="addCompanyActivities{{$loop->index}}"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="addCompanyActivitiesLabel{{$loop->index}}"
    aria-hidden="true"
    >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('work.bind.company.activities', [$work->id, $company->id]) }}#companies-list-section" method="post">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyActivitiesLabel{{$loop->index}}">Incluir Atividades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3>{{ $company->trading_name }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($activityFields as $activityField)
                                <div class="col-md-6 mb-1 mt-1">
                                    <input
                                        type="checkbox"
                                        name="activity_fields_list[]"
                                        value="{{ $activityField->id }}"
                                        class="form-check-input me-1"
                                        id="activities-list-{{ $company->id.$loop->index }}"
                                        @if(
                                            $work->companyActivityFields()
                                                ->where('activity_field_work.company_id', $company->id)
                                                ->where('activity_field_id', $activityField->id)
                                                ->exists()
                                            )
                                            checked
                                        @endif
                                        />
                                    <label
                                        class="form-check-label"
                                        for="activities-list-{{ $company->id.$loop->index }}">
                                        {{ $activityField->description }}
                                    </label>
                                </div>
                            @endforeach
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
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End the Modal -->
