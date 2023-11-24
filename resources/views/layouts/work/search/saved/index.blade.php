@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class='col-md-12'>
                    <div class='alert alert-info'><h4>Salvando pesquisa de obras</h4></div>
                </div>
                

                <div class="col-md-12 mt-2 mb-3 clearfix">
                    <form name="export_form" action="{{ route('work.search.saved') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label><strong>Nome da pesquisa:</strong></label>
                            <input type="text" name="search_name" class='form-control' value="" placeholder='Digite o nome da pesquisa...' required="">
                        </div>
                        
                        <input type="hidden" id="input_select_all_1" name="input_select_all_1" value="{{ $inputSelectAll }}">
                        <input type="hidden" id="input_page_of_pagination_1" name="input_page_of_pagination_1" value="{{ $inputPageOfPagination }}">
                        <input type="hidden" id="clicked_in_page_1" name="clicked_in_page_1" value="{{ $clickedInPage }}">

                        <input type="hidden" id="last_review_from_1" name="last_review_from_1" value="{{ convertPtBrDateToEnDate(request()->last_review_from) }}">
                        <input type="hidden" id="last_review_to_1" name="last_review_to_1" value="{{ convertPtBrDateToEnDate(request()->last_review_to) }}">
                        <input type="hidden" id="investment_standard_1" name="investment_standard_1" value="{{ request()->investment_standard }}">
                        <input type="hidden" id="name_1" name="name_1" value="{{ request()->name }}">
                        <input type="hidden" id="old_code_1" name="old_code_1" value="{{ request()->old_code }}">
                        <input type="hidden" id="address_1" name="address_1" value="{{ request()->address }}">
                        <input type="hidden" id="district_1" name="district_1" value="{{ request()->district }}">
                        <input type="hidden" id="qa_1" name="qa_1" value="{{ request()->qa }}">
                        <input type="hidden" id="total_area_1" name="total_area_1" value="{{ request()->total_area }}">
                        <input type="hidden" id="qi_1" name="qi_1" value="{{ request()->qi }}">
                        <input type="hidden" id="price_1" name="price_1" value="{{ request()->price }}">
                        <input type="hidden" id="qr_1" name="qr_1" value="{{ request()->qr }}">
                        <input type="hidden" id="state_id_1" name="state_id_1" value="{{ request()->state_id }}">
                        <input type="hidden" id="cities_ids_1" name="cities_ids_1" value="{{ request()->cities_ids }}">
                        <input type="hidden" id="researcher_id_1" name="researcher_id_1" value="{{ request()->researcher_id }}">
                        <input type="hidden" id="revision_1" name="revision_1" value="{{ request()->revision }}">
                        <!-- participating_company -->
                        <input type="hidden" id="search_1" name="search_1" value="{{ request()->search }}">
                        <!-- Modalidade -->
                        <input type="hidden" id="modality_id_1" name="modality_id_1" value="{{ request()->modality_id }}">
                        <!-- Pavimento -->
                        <input type="hidden" id="floor_1" name="floor_1" value="{{ request()->floor }}">

                        @foreach ($statesChecked as $stateChecked)
                        <input type="hidden" name="states[]" value="{{ $stateChecked }}">
                        @endforeach
                        @foreach ($segmentSubTypesChecked as $segmentSubTypeChecked)
                        <input type="hidden" name="segment_sub_types[]" value="{{ $segmentSubTypeChecked }}">
                        @endforeach
                        @foreach ($stagesChecked as $stageChecked)
                        <input type="hidden" name="stages[]" value="{{ $stageChecked }}">
                        @endforeach
                        
                        <div class='modal-footer'>
                            <button type="submit" class='btn btn-success'>
                                Salvar pesquisa de obras
                            </button>
                        </div>
                    </form>
                </div>
        
            </div>
        </div>
    </div>
@endsection

