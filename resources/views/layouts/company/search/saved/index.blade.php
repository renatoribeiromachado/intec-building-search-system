@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class='col-md-12'>
                    <div class='alert alert-info'><h4>Salvando pesquisa de empresas</h4></div>
                </div>
                
                <div class="col-md-12 mt-2 mb-3 clearfix">
                    <form name="export_form" action="{{ route('company.search.saved') }}" method="post">
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
                        
                        <!-- Estados -->
                        @foreach ($statesChecked as $stateChecked)
                            <input type="hidden" name="states[]" value="{{ $stateChecked }}">
                        @endforeach

                        <!-- Segmento -->
                        @foreach ($activityFieldsChecked as $activityFieldChecked)
                            <input type="hidden" name="activity_fields[]" value="{{ $activityFieldChecked }}">
                        @endforeach
                        
                        <!--Filtro especifico-->
                        <input type="hidden" id="search_1" name="search_1" value="{{ request()->search }}">
                        <input type="hidden" id="searchCompany_1" name="searchCompany_1" value="{{ request()->searchCompany }}">
                        <input type="hidden" id="address_1" name="address_1" value="{{ request()->address }}">
                        <input type="hidden" id="district_1" name="district_1" value="{{ request()->district }}">
                        <input type="hidden" id="state_id_1" name="state_id_1" value="{{ request()->state_id }}">
                        <input type="hidden" id="cities_ids_1" name="cities_ids_1" value="{{ request()->cities_ids }}">
                        <input type="hidden" id="home_page_1" name="home_page_1" value="{{ request()->home_page }}">
                        <input type="hidden" id="cnpj_1" name="cnpj_1" value="{{ request()->cnpj }}">
                        <input type="hidden" id="primary_email_1" name="primary_email_1" value="{{ request()->primary_email }}">
                        <input type="hidden" id="researcher_id_1" name="researcher_id_1" value="{{ request()->researcher_id }}">
                       
                        <div class='modal-footer'>
                            <button type="submit" class='btn btn-success'>
                                Salvar pesquisa de empresa
                            </button>
                        </div>
                    </form>
                </div>
        
            </div>
        </div>
    </div>
@endsection