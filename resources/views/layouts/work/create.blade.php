@extends('layouts.app_customer_create')

@section('content')

<div class="container">
    <div class="row bg-light p-5 rounded">
        <h3>CADASTRO DE OBRA</h3>

        <form action="{{ route('work.store') }}" method="POST" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_work')

            <div class="form-row my-3">
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        >
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#segment').bind('change', function () {
                    var segment = $(this).val();

                    if (segment.length > 0) {

                        $.ajax({
                            type: "GET",
                            url: base_url() + 'v1/segment-sub-types',
                            data: {'_token': $('meta[name=csrf-token]').attr('content'), segment: segment},
                            success: function (return_data) {
                                if (return_data.segmentSubTypes.length <= 0) {
                                    let segmentHtml = `<option
                                                    value=""
                                                    style="background:#fff;color:#454c54;"
                                                    >
                                                    Sub-tipos não encontrados.
                                                </option>`;
                                    $('select[name="segment_sub_type_id"]').html(segmentHtml);
                                } else {

                                    var options = '<option value="" style="background:#fff;color:#454c54;">-- Selecione --</option>';
                                    
                                    for (var i = 0; i < return_data.segmentSubTypes.length; i++) {
                                        if (return_data.segmentSubTypes[i] !== "") {
                                            options += '<option value="' + return_data.segmentSubTypes[i].id
                                                + '" style="background:#fff;color:#454c54;">'
                                                + return_data.segmentSubTypes[i].description + '</option>';
                                        }
                                    }
                                    $('select[name="segment_sub_type_id"]').html(options);
                                }
                            },
                            error: function (event) {
                                console.log(event)
                                let segmentHtml = `<option
                                                    value=""
                                                    style="background:#fff;color:#454c54;"
                                                    >
                                                    Sub-tipos não encontrados.
                                                </option>`;
                                $('select[name="segment_sub_type_id"]').html(segmentHtml);
                            }
                        });
                        
                    } else {
                        // $('#span-subtipo').hide();
                    }
                });

                $('#phase').bind('change', function () {
                    var phase = $(this).val();

                    if (phase.length > 0) {
                        
                        $.ajax({
                            type: "GET",
                            url: base_url() + 'v1/stages',
                            data: {'_token': $('meta[name=csrf-token]').attr('content'), phase: phase},
                            success: function (return_data) {
                                if (return_data.stages.length <= 0) {
                                    let phaseHtml = `<option
                                                    value=""
                                                    style="background:#fff;color:#454c54;"
                                                    >
                                                    Estágios não encontrados.
                                                </option>`;
                                    $('select[name="stage_id"]').html(html);
                                } else {

                                    var options = '<option value="" style="background:#fff;color:#454c54;">-- Selecione --</option>';
                                    
                                    for (var i = 0; i < return_data.stages.length; i++) {
                                        if (return_data.stages[i] !== "") {
                                            options += '<option value="' + return_data.stages[i].id
                                                + '" style="background:#fff;color:#454c54;">'
                                                + return_data.stages[i].description + '</option>';
                                        }
                                    }
                                    $('select[name="stage_id"]').html(options);
                                }
                            },
                            error: function (event) {
                                console.log(event)
                                let phaseHtml = `<option
                                                value=""
                                                style="background:#fff;color:#454c54;"
                                                >
                                                Estágios não encontrados.
                                            </option>`;
                                $('select[name="stage_id"]').html(html);
                            }
                        });
                        
                    } else {
                        // $('#span-subtipo').hide();
                    }
                });
            })
        </script>
    @endpush
@endsection
