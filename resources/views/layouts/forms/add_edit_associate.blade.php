<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="old_code"
            label-text="Cód:"
            input-type="text"
            input-name="old_code"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $associate->old_code }}"
            :input-readonly="false"
            maxlength="14"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="linked_company"
            {{-- Selecione o CNPJ para esse associado: --}}
            label-text="CNPJ para esse associado:"
            input-type="text"
            input-name="linked_company"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $associate->linked_company
                ? $associate->linked_company
                : '30.252.400/0001-55' }}"
            :input-readonly="true"
        />
    </div>
    
    <div class="col-md-2 mb-2">
        <label><strong>Status:</strong></label>
        <select name="is_active" class="form-select" id="is_active_select">
            @if($company->is_active == 1)
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            @else
                <option value="0">Inativo</option>
                <option value="1">Ativo</option>
            @endif
        </select>
    </div>
    
    <div class="col-md-2 mb-2" style="display: none;">
        <label class="text-danger"><strong>Motivo:</strong></label>
        <select name="reason" class="form-select">
            @if($company->reason === null)
                <option value=''>--Informe o motivo--</option>
            @else
                <option value="{{ $company->reason }}">{{ $company->reason }}</option>
            @endif
            <option value="Ex-cliente">Ex-cliente</option>
            <option value="Suspenso">Suspenso</option>
        </select>
    </div>
    
    <script>
        function toggleReasonInput() {
            let is_activeSelect = document.getElementById('is_active_select');
            let reasonInput = document.querySelector('select[name="reason"]');

            if (is_activeSelect.value === '0') {
                reasonInput.parentElement.style.display = 'block';
            } else {
                reasonInput.parentElement.style.display = 'none';
            }
        }
        
        let is_activeSelect = document.getElementById('is_active_select');
        is_activeSelect.addEventListener('change', toggleReasonInput);

        toggleReasonInput();
    </script>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="phone_one"
            label-text="Telefone:"
            input-type="text"
            input-name="phone_one"
            class-one="phone"
            label-class="label-font-bold"
            input-value="{{ $company->phone_one }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="primary_email"
            label-text="E-mail Principal:"
            input-type="email"
            input-name="primary_email"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->primary_email }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-input
            label-input-id="company_name"
            label-text="Razão Social:"
            input-type="text"
            input-name="company_name"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->company_name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="trading_name"
            label-text="Fantasia:"
            input-type="text"
            input-name="trading_name"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->trading_name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="data_filter_starts_at"
            label-text="Início de Visualização:"
            input-type="text"
            input-name="data_filter_starts_at"
            class-one="datepicker"
            label-class="label-font-bold"
            input-value="{{ optional($associate->data_filter_starts_at)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="data_filter_ends_at"
            label-text="Término de Visualização:"
            input-type="text"
            input-name="data_filter_ends_at"
            class-one="datepicker"
            label-class="label-font-bold"
            input-value="{{ optional($associate->data_filter_ends_at)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <x-intec-input
            label-input-id="cnpj"
            label-text="CNPJ:"
            input-type="text"
            input-name="cnpj"
            class-one="cnpj"
            label-class="label-font-bold"
            input-value="{{ $company->cnpj }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="state_registration"
            label-text="Inscrição Estadual:"
            input-type="text"
            input-name="state_registration"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->state_registration }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-select
            select-name="business_branch"
            select-label="Ramo:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$businessBranches"
            value="{{ $associate->business_branch }}"
        />
    </div>

    <div class="col-md-3">
        <x-intec-select
            select-name="activity_field_id"
            select-label="Atividade:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$activityFields"
            value="{{ $company->activity_field_id }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="company_date_birth"
            label-text="Aniversário da empresa:"
            input-type="text"
            input-name="company_date_birth"
            class-one="datepicker"
            label-class="label-font-bold"
            input-value="{{ $associate->company_date_birth }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="home_page"
            label-text="Site:"
            input-type="text"
            input-name="home_page"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->home_page }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="contract_due_date_start"
            label-text="Emissão:"
            input-type="text"
            input-name="contract_due_date_start"
            class-one="datepicker"
            label-class="label-font-bold"
            input-value="{{ optional($associate->contract_due_date_start)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-select
            select-name="salesperson_id"
            select-label="Vendedor(a):"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$salespersons"
            value="{{ $associate->salesperson_id }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="zip_code"
            label-text="CEP:"
            input-type="text"
            input-name="zip_code"
            class-one="cep"
            label-class="label-font-bold"
            input-value="{{ $company->zip_code }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-5">
        <x-intec-input
            label-input-id="address"
            label-text="Endereço:"
            input-type="text"
            input-name="address"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->address }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="number"
            label-text="Nº:"
            input-type="text"
            input-name="number"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->number }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="complement"
            label-text="Complemento:"
            input-type="text"
            input-name="complement"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->complement }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-input
            label-input-id="district"
            label-text="Bairro:"
            input-type="text"
            input-name="district"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->district }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="city"
            label-text="Cidade:"
            input-type="text"
            input-name="city"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $company->city }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <label><strong>Estado:</strong></label>
        <select name="state" class="form-select" id="state">
            <option value="">--Selecione--</option>
            @foreach($states as $state)
                <option value='{{ $state }}' @if($state == $company->state) selected @endif>{{ $state }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-2">
        @if($company->classification == null)
            <label><strong>Classificação:</strong></label>
        @elseif($company->classification == 'Neutro')
            <label class="text-primary"><strong>Classificação:</strong></label>
            <span class="text-primary"><i class="fa fa-check"></i></span>
        @elseif($company->classification == 'Satisfeito')
            <label class="text-success"><strong>Classificação:</strong></label>
            <span class="text-success"><i class="fa fa-thumbs-o-up"></i></span>
        @elseif($company->classification == 'Insatisfeito')
            <label class="text-danger"><strong>Classificação:</strong></label>
            <span class="text-danger"><i class="fa fa-thumbs-o-down"></i></span>
        @endif
        <select name="classification" class="form-select">
            <option value="" style="color: gray;">--Selecione--</option>
            <option value="Neutro" style="color: blue;" @if($company->classification == 'Neutro') selected @endif>Neutro</option>
            <option value="Satisfeito" style="color: green;" @if($company->classification == 'Satisfeito') selected @endif>Satisfeito</option>
            <option value="Insatisfeito" style="color: red;" @if($company->classification == 'Insatisfeito') selected @endif>Insatisfeito</option>
        </select>
    </div>
    
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-input
            label-input-id="products_and_services"
            label-text="Produtos e serviços:"
            input-type="text"
            input-name="products_and_services"
            class-one=""
            label-class="label-font-bold"
            input-value="{{ $associate->products_and_services }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-textarea
            label-textarea-id="notes"
            label-text="Observações:"
            textarea-type="text"
            textarea-name="notes"
            class-one=""
            label-class="label-font-bold"
            textarea-value="{{ $company->notes }}"
            :textarea-readonly="false"
            rows="5"
        />
    </div>
</div>
